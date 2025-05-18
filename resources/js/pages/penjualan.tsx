import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

interface Penjualan {
  id: number;
  pembelian: {
    nama_barang: string;
    no_invoice: string;
  } | null;
  nama_pelanggan: string;
  tanggal_penjualan: string;
  quantity_jual: number;
  total_harga_jual: number;
}

interface Props {
  penjualans: Penjualan[];
}

export default function Index({ penjualans }: Props) {
//   const breadcrumbs: BreadcrumbItem[] = [
//     { label: 'Dashboard', href: '/' },
//     { label: 'Penjualan', href: '/penjualan', active: true },
//   ];

  return (
    <AppLayout>
        <Head title="Penjualan" />
        {/* Breadcrumbs can be added here if needed */}
        {/* <Breadcrumb items={breadcrumbs} /> */}
    
        {/* Tabel Penjualan */}
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-4">Data Penjualan</h1>
        <div className="overflow-x-auto rounded-lg border border-gray-200 shadow">
          <table className="min-w-full bg-white text-sm">
            <thead>
              <tr className="bg-indigo-400 text-left text-white font-semibold">
                {/* <th className="px-6 py-3">ID</th> */}
                <th className="px-6 py-3">Nama Barang</th>
                <th className="px-6 py-3">No Invoice</th>
                {/* <th className="px-6 py-3">Nama Pelanggan</th> */}
                <th className="px-6 py-3">Tanggal Penjualan</th>
                <th className="px-6 py-3">Qty Jual</th>
                <th className="px-6 py-3">Total Harga Jual</th>
              </tr>
            </thead>
            <tbody>
              {penjualans.length > 0 ? (
                penjualans.map((penjualan) => (
                  <tr key={penjualan.id} className="hover:bg-gray-50">
                    {/* <td className="px-6 py-4">{penjualan.id}</td> */}
                    <td className="px-6 py-4">{penjualan.pembelian?.nama_barang || '-'}</td>
                    <td className="px-6 py-4">{penjualan.pembelian?.no_invoice || '-'}</td>
                    {/* <td className="px-6 py-4">{penjualan.nama_pelanggan}</td> */}
                    <td className="px-6 py-4">{penjualan.tanggal_penjualan}</td>
                    <td className="px-6 py-4">{penjualan.quantity_jual}</td>
                    <td className="px-6 py-4">
                      Rp {Number(penjualan.total_harga_jual).toLocaleString('id-ID')}
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan={7} className="text-center py-6 text-gray-500">
                    Tidak ada data penjualan.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </AppLayout>
  );
}
