<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use App\Interface\FetchDataInterface;
use App\Entity\ExchangeRate;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ExchangeRateService
{
    private $em;
    public function __construct(private ManagerRegistry $mr, private FetchDataInterface $fetchDataInterface, private ParameterBagInterface $params)
    {
        $this->em = $mr->getManagerForClass(get_class(new ExchangeRate()));
    }

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     *
     * @return ExchangeRate[]|array
     */
    public function getExchangeRateHistory(string $fromCurrency, string $toCurrency)
    {
        if ($fromCurrency && $toCurrency) {
            return $this->em->getRepository(ExchangeRate::class)
                ->findBy(['fromCurrency' => $fromCurrency, 'toCurrency' => $toCurrency], ['createdAt' => 'DESC']);
        }
    }

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     *
     * @return array
     */
    public function getExchangeRate(string $fromCurrency, string $toCurrency): array
    {
        try {
            $currencies = CurrencyService::getCurrencies();
            $fromCurrencyMatch = in_array($fromCurrency, array_column($currencies, 'code'));
            $toCurrencyMatch = in_array($toCurrency, array_column($currencies, 'code'));
            if ($fromCurrencyMatch && $toCurrencyMatch && $fromCurrency != $toCurrency) {
                $url = $this->params->get('exchange_rate_api') . '&from=' . $fromCurrency . '&to=' . $toCurrency;
                $data = ['url' => $url];
                $data = $this->fetchDataInterface->fetchData($data);
                    
                if (!$data['error']) {
                    $rate = $data['amount'];
                                    
                    $exchangeRate = new ExchangeRate();
                    $exchangeRate->setFromCurrency($fromCurrency);
                    $exchangeRate->setToCurrency($toCurrency);
                    $exchangeRate->setRate($rate);
                    $exchangeRate->setCreatedAt(new \DateTime());

                    $this->em->getRepository(ExchangeRate::class)->save($exchangeRate, true);

                    return ['msg' => 'Success', 'status' => 'success'];
                } else {
                    return ['msg' => $data['error_message'], 'status' => 'error'];
                }
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            
            return ['status' => 'error', 'msg' => 'Failed to fetch exchange rate:'. $errorMessage];
        }
    }
}
