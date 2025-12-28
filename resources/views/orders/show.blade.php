<x-layouts.app :title="__('訂單明細')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="mb-4 text-lg font-semibold">
                訂單編號：{{ $order->id }}
            </h2>

            @if($order->orderItems->count() === 0)
                <p class="text-neutral-600 dark:text-neutral-300">
                    此訂單沒有任何商品。
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">商品名稱</th>
                                <th class="py-2 px-3">數量</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $orderItem)
                                <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                    <td class="py-2 px-3">{{ $orderItem->id }}</td>
                                    <td class="py-2 px-3">
                                        {{ $orderItem->product->name }}
                                    </td>
                                    <td class="py-2 px-3">
                                        {{ $orderItem->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
