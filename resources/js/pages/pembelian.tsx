import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';

interface Pembelian {
  id: number;
  no_invoice: string;
  no_faktur: string;
  nama_barang: string;
  nama_supplier: string;
  tanggal_pembelian: string;
  quantity_beli: number;
    harga_satuan: number;
  total_harga_beli: number;
}

interface Props {
  pembelians: Pembelian[];
}

export default function PembelianIndex({ pembelians }: Props) {
  return (
    <AppLayout>
      <Head title="Pembelian" />
      <div className="p-6">
        <h1 className="text-2xl font-bold">Data Pembelian</h1>

        {/* Tabel Pembelian */}
<table className="min-w-full mt-6 rounded-lg overflow-hidden shadow-md">
  <thead className="bg-indigo-400 text-white">
    <tr>
      {/* <th className="px-6 py-3 text-left text-sm font-semibold">ID</th> */}
      <th className="px-3 py-3 text-left text-sm font-semibold">No Invoice</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">No Faktur</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">Nama Barang</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">Nama Supplier</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">Tanggal</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">Qty</th>
        <th className="px-6 py-3 text-left text-sm font-semibold">Harga Satuan</th>
      <th className="px-6 py-3 text-left text-sm font-semibold">Total Harga</th>
    </tr>
  </thead>
  <tbody className="bg-white divide-y divide-gray-200">
    {pembelians.map((pembelian) => (
      <tr key={pembelian.id} className="hover:bg-gray-50">
        {/* <td className="px-6 py-4 text-sm text-gray-700">{pembelian.id}</td> */}
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.no_invoice}</td>
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.no_faktur}</td>
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.nama_barang}</td>
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.nama_supplier}</td>
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.tanggal_pembelian}</td>
        <td className="px-6 py-4 text-sm text-gray-700">{pembelian.quantity_beli}</td>
        <td className="px-6 py-4 text-sm text-gray-700">Rp {Number(pembelian.harga_satuan).toLocaleString('id-ID')}</td>
        <td className="px-6 py-4 text-sm text-gray-700">Rp {Number(pembelian.total_harga_beli).toLocaleString('id-ID')}</td>
      </tr>
    ))}
  </tbody>
</table>

      </div>
    </AppLayout>
  );
}
