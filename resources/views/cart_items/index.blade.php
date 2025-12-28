<x-layouts.app :title="__('購物車內容')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="mb-4 text-lg font-semibold">購物車項目</h2>

            @if($cartItems->count() === 0)
                <p class="text-neutral-600 dark:text-neutral-300">您的購物車是空的。</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">商品名稱</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr class="border-b border-neutral-200 dark:border-neutral-700">
                                    <td class="py-2 px-3">{{ $cartItem->id }}</td>
                                    <td class="py-2 px-3">
                                        {{ $cartItem->product->name ?? '（找不到商品）' }}
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
