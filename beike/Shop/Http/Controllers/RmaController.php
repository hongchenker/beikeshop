<?php
/**
 * RmaController.php
 *
 * @copyright  2022 opencart.cn - All Rights Reserved
 * @link       http://www.guangdawangluo.com
 * @author     TL <mengwb@opencart.cn>
 * @created    2022-08-03 21:17:04
 * @modified   2022-08-03 21:17:04
 */

namespace Beike\Shop\Http\Controllers;

use Beike\Repositories\RmaRepo;
use Beike\Shop\Http\Requests\RmaRequest;
use Beike\Shop\Services\RmaService;
use Illuminate\Http\Request;

class RmaController extends Controller
{
    public function index(Request $request)
    {
        $rmas = RmaRepo::listByCustomer(current_customer());
        $data = [
            'rmas' => $rmas,
        ];

        return view('rmas.index', $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        $data = [
            'rma' => RmaRepo::find($id),
            'statuses' => RmaRepo::getStatuses(),
            'types' => RmaRepo::getTypes(),
        ];
        return view('rms/info', $data);
    }

    public function create(int $orderProductId)
    {
        $data = [
            'orderProductId' => $orderProductId,
            'statuses' => RmaRepo::getStatuses(),
            'types' => RmaRepo::getTypes(),
        ];
        return view('rms/form', $data);
    }

    public function store(RmaRequest $request)
    {
        $rma = RmaService::createFromShop($request->only('order_product_id', 'quantity', 'opened', 'rma_reason_id', 'type', 'comment'));

        return json_success('售后服务申请提交成功', $rma);
    }
}
