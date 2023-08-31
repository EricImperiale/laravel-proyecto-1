<?php

namespace App\View\Components;

use App\Models\Movie;
use App\PaymentProviders\MercadoPagoPayment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MovieData extends Component
{
    public function __construct(
        public Movie $movie,
        public MercadoPagoPayment $payment,
        public ?string $route
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.movie-data');
    }
}
