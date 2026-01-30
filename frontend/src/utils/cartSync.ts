import { fetchCart, addToCart, updateCart } from '../api/cart';

type LocalCartItem = { menu_item_id: number; quantity: number };

export async function syncLocalCartToServer(invalidate?: () => Promise<unknown>) {
  try {
    const raw = localStorage.getItem('cart');
    if (!raw) return;
    const local: LocalCartItem[] = JSON.parse(raw || '[]');
    if (!local || local.length === 0) return;

    const serverRes = await fetchCart();
    const serverItems: LocalCartItem[] = serverRes.items || [];

    const serverMap = new Map<number, number>();
    serverItems.forEach((it) => serverMap.set(it.menu_item_id, it.quantity));

    for (const item of local) {
      const existingQty = serverMap.get(item.menu_item_id) ?? 0;
      const totalQty = existingQty + (item.quantity || 1);
      if (existingQty === 0) {
        await addToCart({ menu_item_id: item.menu_item_id, quantity: item.quantity || 1 });
      } else {
        await updateCart({ menu_item_id: item.menu_item_id, quantity: totalQty });
      }
    }

    // clear local cart after successful merge
    localStorage.removeItem('cart');
    if (invalidate) await invalidate();
  } catch (err) {
    // swallow errors; sync is best-effort
    // console.error('cart sync error', err);
  }
}
