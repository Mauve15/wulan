// import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
// import AppLayout from '@/layouts/app-layout';
// import { type BreadcrumbItem } from '@/types';
// import { Head } from '@inertiajs/react';

// const breadcrumbs: BreadcrumbItem[] = [
//     {
//         title: 'Dashboard',
//         href: '/dashboard',
//     },
// ];

// export default function Dashboard() {
//     return (
//         <AppLayout breadcrumbs={breadcrumbs}>
//             <Head title="Dashboard" />
//             <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
//                 <div className="grid auto-rows-min gap-4 md:grid-cols-3">
//                     <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                     <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                     <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border">
//                         <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                     </div>
//                 </div>
//                 <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
//                     <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
//                 </div>
//             </div>
//         </AppLayout>
//     );
// }
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import StatCard from '@/components/StatCard';
import Calendar from '@/components/Calendar';
import Chart from '@/components/Chart';
import TopScorerCard from '@/components/TopScorerCard';

interface Props {
  totalQuantityBeli: number; // Total quantity pembelian
  totalQuantityJual: number; // Total quantity penjualan
  totalQuantityBarang: number; // Total quantity barang
  totalHargaPembelian: number; // Total harga pembelian
  totalNilaiBarang: number;
  totalHargaJual: number; // Total harga penjualan
  totalSelisih: number; // Selisih antara total harga pembelian dan penjualan
  totalBarangTersedia: number;
  totalQuantityBarangA: number; // Total quantity barang
  totalQuantityTersedia: number; // Total quantity tersedia di barang
  quantityBarang: number;
}

// Fungsi untuk memformat angka menjadi IDR
const formatIDR = (amount: number) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
  }).format(amount);
};

export default function Dashboard(props: Props) {
  return (
    <AppLayout>
      <Head title="Dashboard" />
      <div className="p-6 space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="text-2xl font-bold">Statistika Barang</h1>
          <input
            type="text"
            placeholder="Search"
            className="border px-4 py-2 rounded-md shadow-sm"
          />
        </div>
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-4"> 
          <StatCard
            title="Qty Pembelian"
            value={props.totalQuantityBeli || 0} // Total quantity pembelian
            color="bg-red-200"
          />
          <StatCard
            title="Qty Penjualan"
            value={props.totalQuantityJual || 0} // Total quantity penjualan
            color="bg-green-200"
          />
           <StatCard
            title="Total Quantity Tersedia"
            value={props.totalQuantityBarang || 0} // Total quantity barang
            color="bg-gray-200"
          />
          <StatCard
            title="Total Pembelian"
            value={formatIDR(props.totalHargaPembelian || 0)} // Total harga pembelian
            color="bg-yellow-200"
          />
          <StatCard
            title="Total Penjualan"
            value={formatIDR(props.totalHargaJual || 0)} // Total harga penjualan
            color="bg-purple-200"
          />
          <StatCard
            title="Selisih"
            value={formatIDR(props.totalSelisih || 0)} // Selisih antara total harga pembelian dan penjualan
            color="bg-blue-200"
          />
         
          <StatCard
            title="Barang Tersedia"
            value={props.totalBarangTersedia || 0} // Total quantity tersedia di barang
            color="bg-orange-200"
          />
          <StatCard
            title="Qty Barang"
            value={props.totalQuantityBarangA || 0}
            color="bg-teal-200"
          />
          <StatCard
            title="Total Nilai Barang"
            value={formatIDR(props.totalNilaiBarang || 0)}
            color="bg-pink-200"
          />


        </div>

        {/* Optional: tampilkan kalender, chart, atau komponen tambahan lain */}
        {/* <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
          <Calendar />
          <Chart />
        </div> */}

        {/* Contoh tambahan komponen */} 
        {/* <TopScorerCard /> */}
      </div>
    </AppLayout>
  );
}
// // lg:grid-cols-4
