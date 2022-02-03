<?php

namespace App\Controllers;

use App\Models\InfostateModel;
use App\Models\OrderModel;
use Exception;

class States extends BaseController
{
    public function updateState($newState, $reference)
    {
        $mdlOrder = new OrderModel();
        $mdlInfoStates = new InfostateModel();

        try {
            $order = $mdlOrder->find($reference);
            $oldState = $order->state_id_state;
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
            ]);
        }

        switch ($oldState) {
            case 1:
                switch ($newState) {
                    case 1:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'El pedido ya se encuentra en estado CREADO.'
                        ]);
                        break;
                    case 2:
                        try {
                            $mdlOrder->update($reference, [
                                'state_id_state' => 2
                            ]);
                            $mdlInfoStates->insert([
                                'id_infostates' => '',
                                'state_id_state' => 2,
                                'order_id_order' => $reference,
                                'dateupdate_infostate' => date("Y-m-d H:i:s")
                            ]);
                        } catch (Exception $e) {
                            return redirect()->back()->with('error', [
                                'title' => 'Alerta!',
                                'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
                            ]);
                        }
                        return redirect()->to(base_url() . route_to('view_list_order', 2, $order->date_order))->with('msg', [
                            'title' => 'Orden cambio de estado!',
                            'body' => 'El estado paso a COCINA'
                        ]);
                        break;
                    case 3:
                        try {
                            $mdlOrder->update($reference, [
                                'state_id_state' => 3
                            ]);
                            $mdlInfoStates->insert([
                                'id_infostates' => '',
                                'state_id_state' => 3,
                                'order_id_order' => $reference,
                                'dateupdate_infostate' => date("Y-m-d H:i:s")
                            ]);
                        } catch (Exception $e) {
                            return redirect()->back()->with('error', [
                                'title' => 'Alerta!',
                                'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
                            ]);
                        }
                        return redirect()->to(base_url() . route_to('view_list_order', 3, $order->date_order))->with('msg', [
                            'title' => 'Orden cambio de estado!',
                            'body' => 'El estado paso a DESPACHADO'
                        ]);
                        break;
                    case 4:
                        try {
                            $mdlOrder->update($reference, [
                                'state_id_state' => 4
                            ]);
                            $mdlInfoStates->insert([
                                'id_infostates' => '',
                                'state_id_state' => 4,
                                'order_id_order' => $reference,
                                'dateupdate_infostate' => date("Y-m-d H:i:s")
                            ]);
                        } catch (Exception $e) {
                            return redirect()->back()->with('error', [
                                'title' => 'Alerta!',
                                'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
                            ]);
                        }
                        return redirect()->to(base_url() . route_to('view_list_order', 4, $order->date_order))->with('msg', [
                            'title' => 'Orden cambio de estado!',
                            'body' => 'El estado paso a DESHABILITADO'
                        ]);
                        break;
                }
                break;
            case 2:
                switch ($newState) {
                    case 1:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado EN COCINA a CREADO.'
                        ]);
                        break;
                    case 2:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'El pedido ya se encuentra EN COCINA.'
                        ]);
                        break;
                    case 3:
                        if ($order->isPrint()) {
                            try {
                                $mdlOrder->update($reference, [
                                    'state_id_state' => 3
                                ]);
                                $mdlInfoStates->insert([
                                    'id_infostates' => '',
                                    'state_id_state' => 3,
                                    'order_id_order' => $reference,
                                    'dateupdate_infostate' => date("Y-m-d H:i:s")
                                ]);
                            } catch (Exception $e) {
                                return redirect()->back()->with('error', [
                                    'title' => 'Alerta!',
                                    'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
                                ]);
                            }
                            return redirect()->to(base_url() . route_to('view_list_order', 3, $order->date_order).'?refOrderToHighlight='.$order->id_order)->with('msg', [
                                'title' => 'Orden cambio de estado!',
                                'body' => 'El estado paso a DESPACHADO'
                            ]);
                        } else {
                            return redirect()->back()->with('error', [
                                'title' => 'Alerta!',
                                'body' => 'DEBES IMPRIMIR LA ORDEN PRIMERO ANTES DE DESPACHARLA'
                            ]);
                        }

                        break;
                    case 4:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede deshabilitar ya que el pedido se encuentra EN COCINA.'
                        ]);
                        break;
                }
                break;
            case 3:
                switch ($newState) {
                    case 1:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado DESPACHADO a CREADO.'
                        ]);
                        break;
                    case 2:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado DESPACHADO a COCINA.'
                        ]);
                        break;
                    case 3:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'El pedido ya se encuentra esta en estado DESPACHADO.'
                        ]);
                        break;
                    case 4:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede deshabilitar ya que el pedido ya fue DESPACHADO.'
                        ]);
                        break;
                }
                break;
            case 4:
                switch ($newState) {
                    case 1:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado DESHABILITADO a CREADO.'
                        ]);
                        break;
                    case 2:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado DESHABILITADO a COCINA.'
                        ]);
                        break;
                    case 3:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'No se puede pasar del estado DESHABILITADO a DESPACHADO.'
                        ]);
                        break;
                    case 4:
                        return redirect()->back()->with('error', [
                            'title' => 'Alerta!',
                            'body' => 'El pedido ya se encuentra esta en estado DESHABILITADO.'
                        ]);
                        break;
                }
                break;
        }
    }
}
