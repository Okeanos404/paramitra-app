@extends('layouts.app')

@section('title', 'Management Dashboard')

@section('content')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800">Business <span class="text-indigo-600">Analytics</span></h2>
        <a href="{{ route('manajemen.report') }}" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-bold bg-indigo-50 px-6 py-3 rounded-xl transition-colors">
            Lihat Laporan Lengkap
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
    </div>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 relative overflow-hidden group">
            <div class="z-10 relative">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Pemasukan</p>
                <h3 class="text-3xl font-black text-emerald-600">Rp {{ number_format($total_revenue, 0, ',', '.') }}</h3>
                <div class="mt-4 inline-block px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="trending-up" class="w-3 h-3 inline"></i> Selesai
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-emerald-50 opacity-[0.2] group-hover:scale-110 transition-transform duration-700">
                <i data-lucide="wallet" class="w-32 h-32"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 relative overflow-hidden group">
            <div class="z-10 relative">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Total Pengeluaran</p>
                <h3 class="text-3xl font-black text-rose-600">Rp {{ number_format($total_expense, 0, ',', '.') }}</h3>
                <div class="mt-4 inline-block px-3 py-1 bg-rose-50 text-rose-600 rounded-full text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="trending-down" class="w-3 h-3 inline"></i> Selesai
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-rose-50 opacity-[0.2] group-hover:scale-110 transition-transform duration-700">
                <i data-lucide="shopping-cart" class="w-32 h-32"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 relative overflow-hidden group">
            <div class="z-10 relative">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Peringatan Stok</p>
                <h3 class="text-3xl font-black text-orange-500">{{ $low_stock_count }} Item</h3>
                <div class="mt-4 inline-block px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="alert-triangle" class="w-3 h-3 inline"></i> Stok < 20
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-orange-50 opacity-[0.2] group-hover:scale-110 transition-transform duration-700">
                <i data-lucide="package-minus" class="w-32 h-32"></i>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 relative overflow-hidden group">
            <div class="z-10 relative">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Pengiriman Aktif</p>
                <h3 class="text-3xl font-black text-blue-600">{{ $active_shipments_count }} Proses</h3>
                <div class="mt-4 inline-block px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold uppercase tracking-widest">
                    <i data-lucide="truck" class="w-3 h-3 inline"></i> Perjalanan
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-blue-50 opacity-[0.2] group-hover:scale-110 transition-transform duration-700">
                <i data-lucide="map" class="w-32 h-32"></i>
            </div>
        </div>
    </div>

    <!-- Animated Chart Section -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10">
        <h3 class="text-xl font-black text-slate-800 mb-6">Tren Finansial (6 Bulan Terakhir)</h3>
        <div class="relative h-[400px] w-full">
            <canvas id="financialChart"></canvas>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Sales -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 overflow-hidden">
            <div class="p-8 border-b border-slate-50">
                <h3 class="text-xl font-black text-slate-800">Penjualan Terakhir</h3>
            </div>
            <div class="overflow-x-auto p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Pelanggan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recent_sales as $sale)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $sale->user->name }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm font-medium">{{ $sale->tanggal_pesanan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right font-black text-emerald-600">+ Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-400">Belum ada penjualan terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Purchases -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/10 overflow-hidden">
            <div class="p-8 border-b border-slate-50">
                <h3 class="text-xl font-black text-slate-800">Pembelian Terakhir</h3>
            </div>
            <div class="overflow-x-auto p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-l-2xl">Supplier</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-r-2xl text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recent_purchases as $purchase)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ optional($purchase->supplier)->nama_supplier ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm font-medium">{{ $purchase->tanggal_po->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right font-black text-rose-600">- Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-400">Belum ada pembelian terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('financialChart').getContext('2d');
        
        // Data dari backend
        const chartData = @json($chartData);
        
        // Gradient untuk Pemasukan (Hijau)
        const gradientPemasukan = ctx.createLinearGradient(0, 0, 0, 400);
        gradientPemasukan.addColorStop(0, 'rgba(16, 185, 129, 0.8)'); // emerald-500
        gradientPemasukan.addColorStop(1, 'rgba(16, 185, 129, 0.1)');
        
        // Gradient untuk Pengeluaran (Merah)
        const gradientPengeluaran = ctx.createLinearGradient(0, 0, 0, 400);
        gradientPengeluaran.addColorStop(0, 'rgba(225, 29, 72, 0.8)'); // rose-600
        gradientPengeluaran.addColorStop(1, 'rgba(225, 29, 72, 0.1)');

        new Chart(ctx, {
            type: 'bar', // Kombinasi bar chart
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: chartData.pemasukan,
                        backgroundColor: gradientPemasukan,
                        borderColor: '#10b981',
                        borderWidth: 2,
                        borderRadius: 8, // Rounded corners for bars
                        borderSkipped: false,
                        tension: 0.4
                    },
                    {
                        label: 'Pengeluaran',
                        data: chartData.pengeluaran,
                        backgroundColor: gradientPengeluaran,
                        borderColor: '#e11d48',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif",
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 14, family: "'Inter', sans-serif" },
                        bodyFont: { size: 14, family: "'Inter', sans-serif" },
                        padding: 16,
                        cornerRadius: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                weight: '500'
                            },
                            color: '#64748b'
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                weight: '500'
                            },
                            color: '#64748b',
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + ' Jt';
                                }
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
