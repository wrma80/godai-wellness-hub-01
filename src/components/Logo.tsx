import { Link } from "@tanstack/react-router";
import symbol from "@/assets/godai-symbol.png";
import logoSage from "@/assets/godai-logo-sage.png";

export function Logo({ variant = "dark" }: { variant?: "dark" | "light" }) {
  // Menu (cream header): apenas o símbolo (sem fundo).
  // Rodapé (sage): logo completo já com fundo sage embutido.
  if (variant === "light") {
    return (
      <Link to="/" className="inline-flex items-center" aria-label="Godai Terapias Integrativas">
        {/* +10% em relação ao tamanho anterior (h-14 → h-[3.85rem]) */}
        <img src={logoSage} alt="Godai Terapias Integrativas" className="h-[3.85rem] w-auto" />
      </Link>
    );
  }
  return (
    <Link to="/" className="group inline-flex items-center" aria-label="Godai Terapias Integrativas">
      <img
        src={symbol}
        alt="Godai Terapias Integrativas"
        className="h-14 w-auto transition-transform group-hover:scale-[1.02] md:h-16"
      />
    </Link>
  );
}
