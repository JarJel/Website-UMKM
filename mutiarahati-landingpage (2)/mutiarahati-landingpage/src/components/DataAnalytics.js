"use client";
import React from "react";
import {
  LineChart,
  BarChart,
  Bar,
  PieChart as RechartsPieChart,
  Pie,
  Cell,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  Line,
} from "recharts";
import { TrendingUp, BarChart3, PieChart as LucidePieChart, Globe } from "lucide-react";

// Data for charts
const studentProgressData = [
  { bulan: "Jan", TK: 85, SD: 88, Persiapan: 82 },
  { bulan: "Feb", TK: 87, SD: 90, Persiapan: 85 },
  { bulan: "Mar", TK: 89, SD: 92, Persiapan: 88 },
  { bulan: "Apr", TK: 91, SD: 94, Persiapan: 90 },
  { bulan: "Mei", TK: 93, SD: 96, Persiapan: 92 },
  { bulan: "Jun", TK: 95, SD: 98, Persiapan: 94 },
];

const subjectPerformanceData = [
  { subject: "Matematika", score: 92 },
  { subject: "Bahasa Indonesia", score: 88 },
  { subject: "IPA", score: 85 },
  { subject: "Bahasa Inggris", score: 90 },
  { subject: "Seni & Budaya", score: 94 },
];

const enrollmentData = [
  { name: "TK", value: 150, color: "#ffde59" },
  { name: "Unit Persiapan", value: 120, color: "#2e884a" },
  { name: "SD", value: 230, color: "#c81b18" },
];

const guruData = [
    { name: "TK", value: 10, color: "#ffde59" },
    { name: "Unit Persiapan", value: 20, color: "#2e884a" },
    { name: "SD", value: 25, color: "#c81b18" },
  ];

export default function DataAnalytics() {
  return (
    <section className="py-20 bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <div className="inline-flex items-center bg-[#333992]/10 text-[#333992] px-4 py-2 rounded-full text-sm font-medium mb-4">
            <TrendingUp className="w-4 h-4 mr-2" />
            Data & Analytics
          </div>
          <h2 className="text-4xl font-bold text-[#333992] mb-4">
            Progres Guru dan Siswa
          </h2>
          <p className="text-xl text-gray-600">
            Data terkini untuk monitoring kemajuan guru dan siswa
          </p>
        </div>

        <div className="grid lg:grid-cols-2 gap-8 mb-12">
          <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div className="flex items-center justify-between mb-6">
              <div>
                <h3 className="text-xl font-bold text-[#333992] mb-2">
                  Distribusi Siswa
                </h3>
                <p className="text-gray-600 text-sm">
                  Jumlah siswa aktif per jenjang pendidikan
                </p>
              </div>
              <div className="p-3 bg-[#333992]/10 rounded-xl">
                <LucidePieChart className="w-6 h-6 text-[#333992]" />
              </div>
            </div>
            <ResponsiveContainer width="100%" height={300}>
              <RechartsPieChart>
                <Pie
                  data={enrollmentData}
                  cx="50%"
                  cy="50%"
                  outerRadius={100}
                  fill="#8884d8"
                  dataKey="value"
                  label={({ name, value }) => `${name}: ${value}`}
                >
                  {enrollmentData.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={entry.color} />
                  ))}
                </Pie>
                <Tooltip
                  contentStyle={{
                    backgroundColor: "#333992",
                    border: "none",
                    borderRadius: "12px",
                    color: "white",
                  }}
                />
              </RechartsPieChart>
            </ResponsiveContainer>
            <div className="grid grid-cols-3 gap-4 mt-4">
              {enrollmentData.map((item, index) => (
                <div
                  key={index}
                  className="text-center p-3 bg-gray-50 rounded-xl"
                >
                  <div
                    className="text-2xl font-bold"
                    style={{ color: item.color }}
                  >
                    {item.value}
                  </div>
                  <div className="text-sm text-gray-600">{item.name}</div>
                </div>
              ))}
            </div>
          </div>

          <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div className="flex items-center justify-between mb-6">
                <div>
                    <h3 className="text-xl font-bold text-[#333992] mb-2">Distribusi Guru</h3>
                    <p className="text-gray-600 text-sm">Jumlah Guru aktif per jenjang pendidikan</p>
                </div>
                <div className="p-3 bg-[#333992]/10 rounded-xl">
                    <LucidePieChart className="w-6 h-6 text-[#333992]" />
                </div>
            </div>
            <ResponsiveContainer width="100%" height={300}>
                <RechartsPieChart>
                    <Pie data={guruData} cx="50%" cy="50%" outerRadius={100} fill="#8884d8" dataKey="value" label={({ name, value }) => `${name}: ${value}`}>
                        {guruData.map((entry, index) => (
                            <Cell key={`cell-${index}`} fill={entry.color} />
                        ))}
                    </Pie>
                    <Tooltip contentStyle={{ backgroundColor: "#333992", border: "none", borderRadius: "12px", color: "white" }} />
                </RechartsPieChart>
            </ResponsiveContainer>
            <div className="grid grid-cols-3 gap-4 mt-4">
                {guruData.map((item, index) => (
                    <div key={index} className="text-center p-3 bg-gray-50 rounded-xl">
                        <div className="text-2xl font-bold" style={{ color: item.color }}>
                            {item.value}
                        </div>
                        <div className="text-sm text-gray-600">{item.name}</div>
                    </div>
                ))}
            </div>
        </div>
        </div>
        <div className="grid lg:grid-cols-2 gap-8 mb-12">
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div className="flex items-center justify-between mb-6">
                    <div>
                        <h3 className="text-xl font-bold text-[#333992] mb-2">Rata-rata Attendence - Guru</h3>
                        <p className="text-gray-600 text-sm">Attendence Report (1 tahun)</p>
                    </div>
                    <div className="p-3 bg-[#333992]/10 rounded-xl">
                        <BarChart3 className="w-6 h-6 text-[#333992]" />
                    </div>
                </div>
                <ResponsiveContainer width="100%" height={300}>
                    <LineChart data={studentProgressData}>
                        <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                        <XAxis dataKey="bulan" stroke="#666" />
                        <YAxis stroke="#666" />
                        <Tooltip contentStyle={{ backgroundColor: "#333992", border: "none", borderRadius: "12px", color: "white" }} />
                        <Line type="monotone" dataKey="TK" stroke="#ffde59" strokeWidth={3} dot={{ fill: "#ffde59", strokeWidth: 2, r: 5 }} />
                        <Line type="monotone" dataKey="SD" stroke="#c81b18" strokeWidth={3} dot={{ fill: "#c81b18", strokeWidth: 2, r: 5 }} />
                        <Line type="monotone" dataKey="Persiapan" stroke="#2e884a" strokeWidth={3} dot={{ fill: "#2e884a", strokeWidth: 2, r: 5 }} />
                    </LineChart>
                </ResponsiveContainer>
                <div className="flex justify-center space-x-6 mt-4">
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#ffde59] rounded-full mr-2"></div><span className="text-sm text-gray-600">TK</span></div>
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#c81b18] rounded-full mr-2"></div><span className="text-sm text-gray-600">SD</span></div>
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#2e884a] rounded-full mr-2"></div><span className="text-sm text-gray-600">Unit Persiapan</span></div>
                </div>
            </div>
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div className="flex items-center justify-between mb-6">
                    <div>
                        <h3 className="text-xl font-bold text-[#333992] mb-2">Rata-rata Mutaba ah - Guru</h3>
                        <p className="text-gray-600 text-sm">Mutaba ah (1 tahun)</p>
                    </div>
                    <div className="p-3 bg-[#333992]/10 rounded-xl">
                        <BarChart3 className="w-6 h-6 text-[#333992]" />
                    </div>
                </div>
                <ResponsiveContainer width="100%" height={300}>
                    <LineChart data={studentProgressData}>
                        <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                        <XAxis dataKey="bulan" stroke="#666" />
                        <YAxis stroke="#666" />
                        <Tooltip contentStyle={{ backgroundColor: "#333992", border: "none", borderRadius: "12px", color: "white" }} />
                        <Line type="monotone" dataKey="TK" stroke="#ffde59" strokeWidth={3} dot={{ fill: "#ffde59", strokeWidth: 2, r: 5 }} />
                        <Line type="monotone" dataKey="SD" stroke="#c81b18" strokeWidth={3} dot={{ fill: "#c81b18", strokeWidth: 2, r: 5 }} />
                        <Line type="monotone" dataKey="Persiapan" stroke="#2e884a" strokeWidth={3} dot={{ fill: "#2e884a", strokeWidth: 2, r: 5 }} />
                    </LineChart>
                </ResponsiveContainer>
                <div className="flex justify-center space-x-6 mt-4">
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#ffde59] rounded-full mr-2"></div><span className="text-sm text-gray-600">TK</span></div>
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#c81b18] rounded-full mr-2"></div><span className="text-sm text-gray-600">SD</span></div>
                    <div className="flex items-center"><div className="w-3 h-3 bg-[#2e884a] rounded-full mr-2"></div><span className="text-sm text-gray-600">Unit Persiapan</span></div>
                </div>
            </div>
        </div>
        <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
          <div className="flex items-center justify-between mb-6">
            <div>
              <h3 className="text-xl font-bold text-[#333992] mb-2">
                Rata-Rata Jurnal Report Guru
              </h3>
              <p className="text-gray-600 text-sm">
                Jurnal Report Guru (1 tahun)
              </p>
            </div>
            <div className="p-3 bg-[#333992]/10 rounded-xl">
              <BarChart3 className="w-6 h-6 text-[#333992]" />
            </div>
          </div>
          <ResponsiveContainer width="100%" height={350}>
            <BarChart
              data={subjectPerformanceData}
              margin={{ top: 20, right: 30, left: 20, bottom: 5 }}
            >
              <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
              <XAxis dataKey="subject" stroke="#666" />
              <YAxis stroke="#666" />
              <Tooltip
                contentStyle={{
                  backgroundColor: "#333992",
                  border: "none",
                  borderRadius: "12px",
                  color: "white",
                }}
              />
              <Bar dataKey="score" fill="#333992" radius={[8, 8, 0, 0]}>
                {subjectPerformanceData.map((entry, index) => (
                  <Cell
                    key={`cell-${index}`}
                    fill={`hsl(${220 + index * 30}, 70%, 50%)`}
                  />
                ))}
              </Bar>
            </BarChart>
          </ResponsiveContainer>
        </div>

        <div className="mt-8 text-center">
          <div className="inline-flex items-center bg-white px-6 py-3 rounded-full shadow-md">
            <Globe className="w-5 h-5 text-[#333992] mr-2" />
            <span className="text-sm text-gray-600">
              Data diambil secara real time
            </span>
          </div>
        </div>
      </div>
    </section>
  );
}