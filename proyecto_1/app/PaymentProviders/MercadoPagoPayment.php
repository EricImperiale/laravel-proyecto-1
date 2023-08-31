<?php

namespace App\PaymentProviders;

use App\Models\Movie;
use Illuminate\Http\Request;
use MercadoPago\Preference;

class MercadoPagoPayment
{
    protected Preference $preference;

    protected array $items = [];

    protected array $backUrls = [];

    protected string $autoReturn = "";

    protected string $publicKey;

    public function __construct() {
        \MercadoPago\SDK::setAccessToken(config('mercadopago.MERCADOPAGO_ACCESS_TOKEN'));
        $this->publicKey = config('mercadopago.MERCADOPAGO_PUBLIC_KEY');
        $this->preference = new Preference();
    }

    public function addItem(Movie $movie): self
    {
        $item = new \MercadoPago\Item();
        $item->title = $movie->title;
        $item->unit_price = $movie->price;
        $item->quantity = 1;

        $this->items[] = $item;

        return $this;
    }

    public function addItems($movies): self
    {
        foreach($movies as $movie) {
            $this->addItem($movie);
        }

        return $this;
    }

    public function withBackUrls(?string $success = null, ?string $pending = null, ?string $failure = null): self
    {
        $this->backUrls = [
            'success' => $success,
            'pending' => $pending,
            'failure' => $failure,
        ];

        return $this;
    }

    public function withAutoReturn(): self
    {
        $this->autoReturn = "approved";

        return $this;
    }

    public function saveMovieIdToSession(Request $request, int $id): self
    {
        $request->session()->put('movie_id', $id);

        return $this;
    }

    public function save()
    {
        $this->preference->items = $this->items;
        $this->preference->back_urls = $this->backUrls;
        $this->preference->auto_return = $this->autoReturn;
        $this->preference->save();
    }

    public function getPublicKey(): null|string
    {
        return $this->publicKey;
    }

    public function getPreferenceId(): null|string
    {
        return $this->preference->id;
    }

    public function getTotal(): float|int
    {
        $total = 0;

        foreach($this->items as $item) {
            $total += $item->quantity * $item->unit_price;
        }

        return $total;
    }

}
