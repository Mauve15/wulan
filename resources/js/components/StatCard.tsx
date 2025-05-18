interface StatCardProps {
  title: string;
  value: number | string;
  color?: string;
}


export default function StatCard({ title, value, color }: StatCardProps) {
  return (
    <div className={`rounded-xl p-4 shadow ${color}`}>
      <h3 className="text-sm font-medium">{title}</h3>
      <p className="text-xl font-bold">{value}</p>
    </div>
  );
}
