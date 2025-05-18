type Props = {
  name: string;
  score: string;
  position: string;
};

export default function TopScorerCard({ name, score, position }: Props) {
  return (
    <div className="bg-white p-3 rounded shadow text-center">
      <h4 className="font-semibold">{name}</h4>
      <p className="text-lg font-bold text-blue-500">{score}</p>
      <p className="text-sm">{position}</p>
    </div>
  );
}
