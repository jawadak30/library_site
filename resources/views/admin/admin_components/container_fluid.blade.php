<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <!-- Total Users -->
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="progress-detail">
                                        <p class="mb-2">{{ trans('mainTrans.total_users') }}</p>
                                        <h4 class="counter">{{ $totalUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Total Categories -->
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="progress-detail">
                                        <p class="mb-2">{{ trans('mainTrans.total_categories') }}</p>
                                        <h4 class="counter">{{ $totalCategories }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Total Livres -->
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="progress-detail">
                                        <p class="mb-2">{{ trans('mainTrans.total_livres') }}</p>
                                        <h4 class="counter">{{ $totalLivres }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Total Reservations -->
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="progress-detail">
                                        <p class="mb-2">{{ trans('mainTrans.total_reservation') }}</p>
                                        <h4 class="counter">{{ $totalReservations }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- New Reservations -->
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="progress-detail">
                                        <p class="mb-2">{{ trans('mainTrans.new_reservations') }}</p>
                                        <h4 class="counter">{{ $newReservations }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>

     <div class="col-md-12 col-lg-4">
        <div class="row">

        </div>
     </div>
    </div>
        </div>
