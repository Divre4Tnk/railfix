<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0 position-relative overflow-visible" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @if (($notif_count = \App\Models\Notification::select('is_read')->where('is_read', false)->count()) > 0)
                            <span class="position-absolute top-0 end-0 badge rounded-pill bg-danger">
                                {{ $notif_count }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown" style="">
                        <div class="dropdown-header py-0 d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Notifikasi</h5>
                            <a href="#!" class="pc-head-link bg-transparent">
                                <i class="ti ti-x text-danger"></i>
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-header p-0 text-wrap header-notification-scroll position-relative"
                            style="max-height: calc(100vh - 215px)" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: -16px 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content" style="padding: 16px 0px;">
                                                <div class="list-group list-group-flush w-100">
                                                    @php
                                                        $notifications = \App\Models\Notification::select('id', 'inventory_id', 'is_read', 'title', 'type')
                                                            ->with('inventory')
                                                            ->latest()->limit(5)->get();
                                                    @endphp
                                                    @forelse ($notifications as $notif)
                                                        <button type="submit" class="list-group-item list-group-item-action {{ $notif->is_read ? '' : 'bg-success-subtle' }}" form="form-read-{{ $notif->id }}">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 ms-1">
                                                                    <span class="float-end text-muted">{{ $notif->inventory->date_in->format('d-m-Y') }}</span>
                                                                    <p class="text-body mb-1">{{ $notif->title }}</p>
                                                                    <span class="text-muted">{{ $notif->inventory->name }} | {{ $notif->inventory->location->name }}</span>
                                                                </div>
                                                            </div>
                                                            <form action="{{ route('notifications.update', $notif->id) }}" method="post" id="form-read-{{ $notif->id }}">
                                                                @csrf
                                                                @method('PUT')
                                                            </form>
                                                        </button>
                                                    @empty
                                                        <p class="mb-0 text-center py-3">Tidak ada notifikasi</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                            </div>
                        </div>
                        @if ($notifications->count() > 0)
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="{{ route('notifications.index') }}" class="link-primary">Lihat Semua</a>
                            </div>
                        @endif
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Kang+Admin" alt="user-image" class="user-avtar">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="https://ui-avatars.com/api/?name=Kang+Admin" alt="user-image"
                                        class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                                    <span>Administrator</span>
                                </div>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout_destroy') }}" method="POST"
                            onsubmit="return confirm('Apakah anda yakin ingin logout?')">
                            @csrf
                            <a href="#" class="dropdown-item text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </form>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
