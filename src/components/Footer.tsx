import { Link } from "@tanstack/react-router";
import { Instagram, MessageCircle, Mail, MapPin } from "lucide-react";
import { Logo } from "./Logo";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export function Footer() {
  const { data } = useSettings();
  const s = data ?? DEFAULT_SETTINGS;
  return (
    <footer className="bg-sage text-cream">
      <div className="mx-auto grid max-w-7xl gap-12 px-6 py-16 md:grid-cols-4 lg:px-10">
        <div className="md:col-span-2">
          <Logo variant="light" />
          <p className="mt-6 max-w-md text-sm leading-relaxed text-cream/75">
            Bem-estar corporativo com equilíbrio e acolhimento. Levamos a Quick Massage
            até a sua empresa para promover saúde, produtividade e qualidade de vida.
          </p>
        </div>

        <div>
          <h4 className="text-xs font-semibold uppercase tracking-[0.2em] text-cream/60">
            Navegação
          </h4>
          <ul className="mt-4 space-y-2 text-sm">
            <li><Link to="/" className="text-cream/85 hover:text-cream">Início</Link></li>
            <li><Link to="/sobre" className="text-cream/85 hover:text-cream">Sobre</Link></li>
            <li><Link to="/servicos" className="text-cream/85 hover:text-cream">Serviços</Link></li>
            <li><Link to="/metodologia" className="text-cream/85 hover:text-cream">Metodologia</Link></li>
            <li><Link to="/contato" className="text-cream/85 hover:text-cream">Contato</Link></li>
          </ul>
        </div>

        <div>
          <h4 className="text-xs font-semibold uppercase tracking-[0.2em] text-cream/60">
            Contato
          </h4>
          <ul className="mt-4 space-y-3 text-sm text-cream/85">
            <li className="flex items-center gap-2">
              <MapPin size={14} /> {s.city}
            </li>
            <li>
              <a href={`mailto:${s.email}`} className="flex items-center gap-2 hover:text-cream">
                <Mail size={14} /> {s.email}
              </a>
            </li>
            <li>
              <a href={buildWhatsappLink(s)} target="_blank" rel="noreferrer" className="flex items-center gap-2 hover:text-cream">
                <MessageCircle size={14} /> WhatsApp
              </a>
            </li>
            <li>
              <a href={s.instagram} target="_blank" rel="noreferrer" className="flex items-center gap-2 hover:text-cream">
                <Instagram size={14} /> Instagram
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div className="border-t border-cream/15">
        <div className="mx-auto flex max-w-7xl flex-col items-start justify-between gap-2 px-6 py-6 text-xs text-cream/60 md:flex-row md:items-center lg:px-10">
          <p>© {new Date().getFullYear()} Godai Terapias Integrativas. Todos os direitos reservados.</p>
          <div className="flex items-center gap-4">
            <p>Bem-estar corporativo com equilíbrio e acolhimento.</p>
            <Link to="/admin" className="text-cream/40 hover:text-cream/80">Painel</Link>
          </div>
        </div>
      </div>
    </footer>
  );
}
