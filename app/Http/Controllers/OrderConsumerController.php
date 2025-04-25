<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class OrderConsumerController extends Controller
{
    /**
     * Mendapatkan riwayat pesanan user
     * CONSUMER: Endpoint ini mengambil data dari OrderService
     */
    public function getUserOrders($userId)
    {
        try {
            // URL OrderService dari config
            $orderServiceUrl = Config::get('services.order_service.url');
            
            // Panggil API OrderService
            $response = Http::get($orderServiceUrl . '/api/orders/user/' . $userId);
            
            // Jika response berhasil
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            // Jika terjadi error dari OrderService
            return response()->json([
                'error' => 'Failed to fetch orders from OrderService',
                'details' => $response->json()
            ], $response->status());
            
        } catch (\Exception $e) {
            // Jika terjadi error koneksi atau lainnya
            return response()->json([
                'error' => 'Error connecting to OrderService',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mendapatkan detail pesanan
     * CONSUMER: Endpoint ini mengambil data dari OrderService
     */
    public function getOrderDetails($orderId)
    {
        try {
            // URL OrderService dari config
            $orderServiceUrl = Config::get('services.order_service.url');
            
            // Panggil API OrderService
            $response = Http::get($orderServiceUrl . '/api/orders/' . $orderId);
            
            // Jika response berhasil
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            // Jika terjadi error dari OrderService
            return response()->json([
                'error' => 'Failed to fetch order details from OrderService',
                'details' => $response->json()
            ], $response->status());
            
        } catch (\Exception $e) {
            // Jika terjadi error koneksi atau lainnya
            return response()->json([
                'error' => 'Error connecting to OrderService',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}