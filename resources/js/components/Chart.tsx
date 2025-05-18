export default function Chart() {
  return (
    <div className="bg-white p-4 rounded shadow">
      <h2 className="text-lg font-semibold mb-2">School Performance</h2>
      <div className="flex justify-around items-end h-40">
        <div className="w-12 bg-purple-600 h-[80%] rounded">Govt</div>
        <div className="w-12 bg-yellow-600 h-[60%] rounded">Private</div>
        <div className="w-12 bg-green-600 h-[70%] rounded">Average</div>
      </div>
    </div>
  );
}
