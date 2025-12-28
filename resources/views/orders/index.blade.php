<x-layouts.app :title="__('訂單列表')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="mb-4 text-lg font-semibold">我的訂單</h2>

            @if($orders->count() === 0)
                <p class="text-neutral-600 dark:text-neutral-300">
                    目前沒有任何訂單。
                </p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                <th class="py-2 px-3">訂單編號</th>
                                <th class="py-2 px-3">下訂時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                    <td class="py-2 px-3">
                                        {{ $order->id }}
                                    </td>
                                    <td class="py-2 px-3">
                                        {{ $order->created_at }}
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
