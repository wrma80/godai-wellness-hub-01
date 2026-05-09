import { Link } from "@tanstack/react-router";
import logo from "@/assets/godai-logo.png";

export function Logo({ variant = "dark" }: { variant?: "dark" | "light" }) {
  // O logo tem fundo Sage embutido. No header (cream) usamos um cartão arredondado
  // com o mesmo verde para dar acabamento de selo. No footer (sage) ele se funde
  // naturalmente ao fundo.
  if (variant === "light") {
    return (
      <Link to="/" className="inline-flex items-center" aria-label="Godai Terapias Integrativas">
        <img src={logo} alt="Godai Terapias Integrativas" className="h-16 w-auto" />
      </Link>
    );
  }
  return (
    <Link to="/" className="group inline-flex items-center" aria-label="Godai Terapias Integrativas">
      <span className="overflow-hidden rounded-xl bg-sage shadow-sm transition-transform group-hover:scale-[1.02]">
        <img src={logo} alt="Godai Terapias Integrativas" className="h-12 w-auto md:h-14" />
      </span>
    </Link>
  );
}
