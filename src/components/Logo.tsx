import { Link } from "@tanstack/react-router";
import logo from "@/assets/godai-logo.png";

export function Logo({ variant = "dark" }: { variant?: "dark" | "light" }) {
  // O novo logo já vem com fundo próprio (claro). No header (cream) usamos direto;
  // no footer (sage) envelopamos em um cartão creme arredondado para garantir contraste.
  if (variant === "light") {
    return (
      <Link to="/" className="inline-flex items-center" aria-label="Godai Terapias Integrativas">
        <span className="inline-flex items-center justify-center rounded-xl bg-cream px-4 py-2 shadow-sm">
          <img src={logo} alt="Godai Terapias Integrativas" className="h-14 w-auto" />
        </span>
      </Link>
    );
  }
  return (
    <Link to="/" className="group inline-flex items-center" aria-label="Godai Terapias Integrativas">
      <img
        src={logo}
        alt="Godai Terapias Integrativas"
        className="h-14 w-auto transition-transform group-hover:scale-[1.02] md:h-16"
      />
    </Link>
  );
}
