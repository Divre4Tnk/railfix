<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckInventoryNotifications extends Command
{
    protected $signature = 'notif:check-inventory';
    protected $description = 'Cek inventory dan buat notifikasi jika belum diproses atau terlalu lama dalam progress';

    public function handle()
    {
        $now = now();

        $receivedItems = Inventory::where('status', 'received')->get();

        foreach ($receivedItems as $item) {
            $daysReceived = $item->date_in->diffInDays($now);

            if ($daysReceived >= 2) {
                $lastNotif = Notification::where('inventory_id', $item->id)
                    ->where('type', 'received')
                    ->latest()
                    ->first();

                if (!$lastNotif) {
                    $this->createNotification($item, 'Mulai pekerjaanmu!');
                } elseif ($lastNotif->is_read && $lastNotif->created_at->diffInDays($now) >= 1) {
                    $this->createNotification($item, 'Mulai pekerjaanmu!');
                }
            }
        }

        $progressItems = Inventory::where('status', 'on_progress')->get();

        foreach ($progressItems as $item) {
            $daysProgress = $item->date_in->diffInDays($now);

            if ($daysProgress >= 3) {
                $lastNotif = Notification::where('inventory_id', $item->id)
                    ->where('type', 'on_progress')
                    ->latest()
                    ->first();

                if (!$lastNotif) {
                    $this->createNotification($item, 'Selesaikan pekerjaanmu!');
                } elseif ($lastNotif->is_read && $lastNotif->created_at->diffInDays($now) >= 1) {
                    $this->createNotification($item, 'Selesaikan pekerjaanmu!');
                }
            }
        }

        $this->info('Notifikasi berhasil diperiksa.');
    }

    private function createNotification(Inventory $inventory, string $title): void
    {
        Notification::create([
            'title' => $title,
            'inventory_id' => $inventory->id,
            'type' => $inventory->status,
            'is_read' => false,
        ]);
    }
}
