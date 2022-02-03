<?php

namespace App\Controllers;

use App\Entities\Order as EntitiesOrder;
use App\Models\AdditionModel;
use App\Models\AdditionproductModel;
use App\Models\CategoryModel;
use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\DomicilioModel;
use App\Models\IngredientModel;
use App\Models\OrderHasPaymentMethodModel;
use App\Models\OrderModel;
use App\Models\PaymentMethodModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;
use App\Models\TypeshippingModel;
use App\Models\WhitadditionModel;
use App\Models\WhitoutingredientModel;
use App\Models\WithadditionModel;
use CodeIgniter\HTTP\URI;
use Exception;

class Order extends BaseController
{
    public function viewLoadOrder($REF)
    {
        $mdlClient = new ClientModel();
        $mdlOrder = new OrderModel();
        $mdlDetailOrder = new DetailorderModel();
        $mdlTypeshipping = new TypeshippingModel();
        $mdlDomicilio = new DomicilioModel();
        $mdlPayment = new PaymentMethodModel();

        return view('admin/contents/order/view_order', [
            'order' => $order = $mdlOrder->find($REF),
            'list_of_products' => $order->getListofProducts(),
            'client' => $mdlClient->find($order->client_id_client),
            'typeshipping' => $mdlTypeshipping->find($order->typeshipping_id_typeshipping),
            'domi' => $mdlDomicilio->find($REF),
            'methodpayments' => $mdlPayment->findAll()
        ]);
    }

    public function createOrder()
    {
        $domicilio = 0;
        if (empty($_SESSION['list_order'])) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No hay productos en el carrito de compras.'
            ]);
        }

        $typeshipping_id_typeshipping = $this->request->getPostGet('typeshipping');

        if (empty($typeshipping_id_typeshipping)) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No recibimos el tipo de envio.'
            ]);
        }

        $employee = session()->cedula_employee;
        /* $REFERENCE = date("Y-m-d") . '-' . time(); */
        $REFERENCE = time();
        $name = $this->request->getPostGet('name');
        $payment_method = $this->request->getPostGet('payment_method');
        $surname = '';
        $observations_order = $this->request->getPostGet('observation');

        if ($typeshipping_id_typeshipping == 1 || $typeshipping_id_typeshipping == 3) {
            if (!$this->validate(
                [
                    'typeshipping' => 'required',
                    'name' => 'required',
                    'whatsapp' => 'required',
                    'payment_method' => 'required'
                ]
            )) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Tuvimos problemas al recibir los datos del pedido.'
                ]);
            }
            if (!$adress = $this->request->getPostGet('adress')) {
                $adress = '';
            }
            if (!$barrio = $this->request->getPostGet('barrio')) {
                $barrio = '';
            }
            $domiciliario = 1;
            $price_domi = 0;
            $whatsapp_domicilio = $this->request->getPostGet('whatsapp');
            if (!$obs_domi = $this->request->getPostGet('obs_domi')) {
                $obs_domi = '';
            }

            $new_domicilio = [
                'id_domicilio' => $REFERENCE,
                'address_domicilio' => $adress,
                'neighborhood_domicilio' => $barrio,
                'domiciliary_id_domiciliary' => $domiciliario,
                'price_domicilio' => $price_domi,
                'whatsapp_domicilio' => $whatsapp_domicilio,
                'observation_domicilio' => $obs_domi
            ];

            $mdlDomicilio = new DomicilioModel();
            $domicilio = $REFERENCE;
            try {
                $mdlDomicilio->insert($new_domicilio);
            } catch (Exception $e) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion del domicilio. <br>Excepción capturada:' .  $e->getMessage()
                ]);
            }
            $typeshipping_id_typeshipping = 1;
        } else if ($typeshipping_id_typeshipping == 2) {
            if (!$this->validate(
                [
                    'typeshipping' => 'required',
                    'name' => 'required',
                    'payment_method' => 'required'
                ]
            )) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Tuvimos problemas al recibir los datos del pedido.'
                ]);
            }
            $domicilio = 1;
        }

        $mdlClient = new ClientModel();

        try {
            $mdlClient->insert([
                'id_client' => $REFERENCE,
                'name_client' => $name,
                'surname_client' => $surname
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Ocurrio un error con el modelo, al tratar de insertar El cliente. <br>Excepción capturada:' .  $e->getMessage()
            ]);
        }

        $new_order = new EntitiesOrder([
            'id_order' => $REFERENCE,
            'typeshipping_id_typeshipping' => $typeshipping_id_typeshipping,
            'darlyturn_order' => '',
            'turnmachine_order' => '',
            'observations_order' => $observations_order,
            'date_order' => '',
            'hour_order' => '',
            'consecutive_order' => '',
            'employee_id_employee' => $employee,
            'domicilio_id_domicilio' => $domicilio,
            'client_id_client' => $REFERENCE,
            'state_id_state' => 2,
        ]);

        $new_order->setTimeCreation();
        $new_order->setConsecutiveOfAllOrders();
        $new_order->setDarlyTurn();
        $new_order->setTurnMachine();

        $mdlOrder = new OrderModel();
        $mdlOrderHasPaymentMethod = new OrderHasPaymentMethodModel();
        try {
            $mdlOrder->insert($new_order);

            //qui vamos a agregar el medio de pago
            $mdlOrderHasPaymentMethod->insert([
                'paymentmethod_id_paymentmethod' => $payment_method,
                'order_id_order' => $REFERENCE
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de la nueva orden. <br>Excepción capturada:' .  $e->getMessage()
            ]);
        }
        //d($new_order);
        //HASTA AQUI SE A CREADO TODO DE LA NUEVA ORDEN BIEN

        //aqui se creara los productos

        $mdlDetailOrder = new DetailorderModel();
        $mdlProducts = new ProductModel();
        $mdlRecipe = new RecipeModel();
        $mdlWhitout = new WhitoutingredientModel();
        $mdlIngredint = new IngredientModel();
        $mdlAdditionProduct = new AdditionproductModel();
        $mdlAddition = new AdditionModel();
        $mdlWithAddition = new WithadditionModel();

        $allproducts = $mdlProducts->getInfoProductsListOrder($_SESSION['list_order']);
        //d($allproducts);
        //d($_SESSION['list_order']);

        foreach ($allproducts as $producttoadd) {
            $newproduct = [
                'id_detailorder' => '',
                'product_id_product' => $producttoadd['id_product'],
                'order_id_order' => $REFERENCE,
                'quantity_detailorder' => $producttoadd['quantity'],
                'priceunit_detailorder' => $producttoadd['price_product']
            ];
            try {
                $id = $mdlDetailOrder->insert($newproduct);
            } catch (Exception $e) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de cada uno de los productos del carrito. <br>Excepción capturada:' .  $e->getMessage()
                ]);
            }

            //se guardan cada uno de los ingredientes que se quieren que no esten en el detalle de la orden
            foreach ($producttoadd['whitout_ingredients'] as $whitout) {
                $new_whit_out = [
                    'detailorder_id_detailorder' => $id,
                    'recipe_id_recipe' => $mdlRecipe->where('product_id_product', $producttoadd['id_product'])->where('ingredient_id_ingredient', $whitout['id_ingredient'])->first()['id_recipe'],
                    'discount_hasnot' => $mdlIngredint->find($whitout['id_ingredient'])['price_ingredient']
                ];
                try {
                    $mdlWhitout->insert($new_whit_out);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', [
                        'title' => 'Alerta!',
                        'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de los ingredientes. <br>Excepción capturada:' .  $e->getMessage()
                    ]);
                }
            }

            //Se guardan cada uno de las adiciones correspondientes al detalles
            foreach ($producttoadd['whit_additions'] as $addition) {
                $new_addition = [
                    'detailorder_id_detailorder' => $id,
                    'product_additions_id_product_additions' => $mdlAdditionProduct->where('product_id_product', $producttoadd['id_product'])->where('addition_id_addition', $addition['id_addition'])->first()['id_product_additions'],
                    'price_more_additions' => $mdlAddition->find($addition['id_addition'])['price_addition']
                ];
                try {
                    $mdlWithAddition->insert($new_addition);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', [
                        'title' => 'Alerta!',
                        'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de las Adiciones. <br>Excepción capturada:' .  $e->getMessage()
                    ]);
                }
            }
        }
        session()->remove('list_order');
        return redirect()->to(base_url() . route_to('view_list_order', 2, date("Y-m-d")) . '?refOrderToHighlight=' . $REFERENCE . '&pago_con=' . $this->request->getPostGet('pago_con'));
    }

    public function viewCreateOrderFinish()
    {
        if (empty($_SESSION['list_order'])) {
            return view('errors/cli/error_verification');
        }
        $mdlProduct = new ProductModel();
        return view('admin/contents/order/view_createorderfinish', [
            'list_order' => $mdlProduct->getInfoProductsListOrder($_SESSION['list_order'])
        ]);
    }

    public function viewCreateOrder()
    {
        $mdlCategory  = new CategoryModel();
        $mdlProduct = new ProductModel();
        if (empty($_SESSION['list_order'])) {
            return view('admin/contents/order/view_createorder', [
                'categories' => $mdlCategory->findAll()
            ]);
        }
        return view('admin/contents/order/view_createorder', [
            'categories' => $mdlCategory->findAll(),
            'list_order' => $mdlProduct->getInfoProductsListOrder($_SESSION['list_order'])
        ]);
    }

    public function addProductToListOrder()
    {
        //VERIFICACION DE LOS VALORES RECIBIDOS
        if (!$this->validate(
            [
                'products-select' => 'required|is_not_unique[product.id_product]',
                'quantity' => 'required|is_natural',
            ]
        )) {
            return redirect()->back();
        }

        //TOMAR LOS VALORES RECIBIDOS
        $product = $this->request->getPostGet('products-select');
        if (!$whitout_ingredients = $this->request->getPostGet('ingredients-div')) {
            $whitout_ingredients = array();
        }
        if (!$whit_additions = $this->request->getPostGet('additions-div')) {
            $whit_additions = array();
        }
        /* d($this->request->getPostGet());
        d($whitout_ingredients); */
        $quantity = $this->request->getPostGet('quantity');
        $item = time() . '-';
        $newItem = [
            $item => [
                'id' => $item,
                'product'  => $product,
                'quantity'     => $quantity,
                'whitout_ingredients'     => $whitout_ingredients,
                'whit_additions' => $whit_additions
            ]
        ];
        if (isset($_SESSION['list_order'])) {
            $this->session->push('list_order', $newItem);
        } else {
            $this->session->set('list_order', $newItem);
        }
        /* dd($_SESSION['list_order']); */
        return redirect()->route('view_createorder');
    }

    public function deleteProductToListOrder()
    {
        if (!$this->validate(
            [
                'id' => 'required',
            ]
        )) {
            return view('errors/cli/error_verification');
        }
        $list_products = $_SESSION['list_order'];
        if (empty($list_products)) {
            return view('errors/cli/error_verification');
        } else {
            $id_to_delete = $this->request->getPostGet('id');
            unset($_SESSION['list_order'][$id_to_delete]);
            return redirect()->route('view_createorder');
        }
    }

    public function cart()
    {
        dd($_SESSION['list_order']);
    }
    public function d()
    {
        $this->session->destroy();
    }

    public function changeMethodPayment()
    {
        $id_order = $this->request->getPost('id_order');
        $mdlHasPayment = new OrderHasPaymentMethodModel();
        $mdlHasPayment
            ->set('paymentmethod_id_paymentmethod', $this->request->getPost('method_payment'))
            ->where('order_id_order', $id_order)
            ->update();

        return redirect()->to(base_url() . route_to('view_load_order', $id_order))->with('msg', [
            'title' => 'Se cambio el metodo de pago',
            'body' => 'El medio de pago de la orden ha cambiado',
        ]);
    }
}
