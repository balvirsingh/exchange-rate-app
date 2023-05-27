<?php

namespace App\Controller;

use App\Entity\ExchangeRate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Service\ExchangeRateService;
use App\Service\CurrencyService;

class ExchangeRateController extends AbstractController
{
   
    /**
     * @param ExchangeRateService $exchangeRateService
     *
     * @return Response
     */
    public function history(string $fromCurrency, string $toCurrency, ExchangeRateService $exchangeRateService): Response
    {
        $exchangeRates = $exchangeRateService->getExchangeRateHistory($fromCurrency, $toCurrency);

        return $this->render('exchange_rate/history.html.twig', [
            'exchangeRates' => $exchangeRates,
            'currencies' => CurrencyService::getCurrencies(),
            'fromCurrency' => $fromCurrency,
            'toCurrency' => $toCurrency
        ]);
    }

    /**
     * @param Request $request
     * @param ExchangeRateService $exchangeRateService
     *
     * @return Response
     */
    public function update(Request $request, ExchangeRateService $exchangeRateService): Response
    {
        if ($request->isMethod('POST')) {
            $fromCurrency = $request->request->get('from_currency');
            $toCurrency = $request->request->get('to_currency');

            if ($fromCurrency && $toCurrency && $fromCurrency!==$toCurrency) {
                $response = $exchangeRateService->getExchangeRate($fromCurrency, $toCurrency);
                $this->addFlash($response['status'], $response['msg']);
            }
        }

        return $this->redirectToRoute('exchange_rate_history', ['fromCurrency' => $fromCurrency, 'toCurrency' => $toCurrency]);
    }
}
