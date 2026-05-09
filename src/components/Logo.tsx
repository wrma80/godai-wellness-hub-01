import { Link } from "@tanstack/react-router";

export function Logo({ variant = "dark" }: { variant?: "dark" | "light" }) {
  const color = variant === "light" ? "text-cream" : "text-sage";
  const sub = variant === "light" ? "text-cream/70" : "text-sage/70";
  return (
    <Link to="/" className="group flex items-center gap-3">
      <span className={`grid h-9 w-9 place-items-center rounded-full border ${variant === "light" ? "border-cream/40" : "border-sage/40"} transition-all group-hover:scale-105`}>
        <span className={`text-[15px] font-bold tracking-tight ${color}`}>五</span>
      </span>
      <span className="flex flex-col leading-none">
        <span className={`text-base font-bold tracking-[0.2em] ${color}`}>GODAI</span>
        <span className={`mt-1 text-[10px] tracking-[0.25em] ${sub}`}>TERAPIAS INTEGRATIVAS</span>
      </span>
    </Link>
  );
}
