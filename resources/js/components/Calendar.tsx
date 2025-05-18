export default function Calendar() {
  return (
    <div className="bg-white p-4 rounded shadow">
      <h2 className="text-lg font-semibold mb-2">Calendar & Attendance</h2>
      <div className="grid grid-cols-7 gap-2 text-center">
        {['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].map((day) => (
          <div key={day} className="font-semibold">{day}</div>
        ))}
        {Array.from({ length: 30 }, (_, i) => (
          <div key={i} className="p-2 bg-gray-100 rounded">{i + 1}</div>
        ))}
      </div>
    </div>
  );
}
