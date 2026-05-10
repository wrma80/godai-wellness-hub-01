import { createFileRoute, Link } from "@tanstack/react-router";
import { ArrowRight, Sparkles, Heart, Leaf, Wind, Flame, Mountain, Droplets, Check } from "lucide-react";
import heroImg from "@/assets/hero-massage.jpg";
import zenImg from "@/assets/about-zen.jpg";
import { useSettings, usePricing, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/")({
  head: () => ({
    meta: [
      { title: "Godai Terapias Integrativas — Quick Massage Corporativa em Indaiatuba" },
      { name: "description", content: "Bem-estar corporativo que transforma ambientes. Quick Massage in company para empresas, SIPATs e programas de qualidade de vida." },
    ],
  }),
  component: HomePage,
});

const ELEMENTS = [
  { icon: Mountain, label: "Terra" },
  { icon: Droplets, label: "Água" },
  { icon: Flame, label: "Fogo" },
  { icon: Wind, label: "Ar" },
  { icon: Sparkles, label: "Éter" },
];

const BENEFITS = [
  "Redução do estresse",
  "Melhora do clima organizacional",
  "Valorização dos colaboradores",
  "Aumento do bem-estar",
  "Ações de qualidade de vida",
  "Experiência corporativa diferenciada",
];

function HomePage() {
  const { data: settings } = useSettings();
  const { data: pricing } = usePricing();
  const s = settings ?? DEFAULT_SETTINGS;
  const rows = pricing ?? [];
  return (
    <>
      {/* HERO */}
      <section className="relative overflow-hidden">
        <div className="mx-auto grid max-w-7xl gap-12 px-6 py-16 md:grid-cols-2 md:items-center md:py-24 lg:px-10">
          <div className="fade-up">
            <span className="inline-flex items-center gap-2 rounded-full border border-sage/20 bg-cream px-4 py-1.5 text-xs font-medium tracking-wider text-sage uppercase">
              <Leaf size={12} /> Bem-estar Corporativo
            </span>
            <h1 className="mt-6 text-4xl leading-[1.1] text-sage-deep md:text-5xl lg:text-6xl">
              Bem-estar corporativo que <em className="not-italic text-sage">transforma</em> ambientes.
            </h1>
            <p className="mt-6 max-w-lg text-base leading-relaxed text-muted-foreground md:text-lg">
              A Godai Terapias Integrativas oferece experiências de relaxamento e qualidade
              de vida diretamente na sua empresa através da Quick Massage Corporativa.
            </p>
            <div className="mt-8 flex flex-wrap gap-3">
              <Link
                to="/contato"
                className="group inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream shadow-sm transition-all hover:bg-sage-deep hover:shadow-md"
              >
                Solicitar orçamento
                <ArrowRight size={16} className="transition-transform group-hover:translate-x-1" />
              </Link>
              <a
                href={whatsappLink()}
                target="_blank"
                rel="noreferrer"
                className="inline-flex items-center gap-2 rounded-full border border-sage/30 px-6 py-3 text-sm font-medium text-sage-deep transition-all hover:border-sage hover:bg-sage/5"
              >
                Falar no WhatsApp
              </a>
            </div>
          </div>

          <div className="relative fade-up-delay-1">
            <div className="absolute -inset-6 -z-10 rounded-[2rem] bg-sage/10 blur-3xl" />
            <div className="overflow-hidden rounded-2xl shadow-2xl">
              <img
                src={heroImg}
                alt="Sessão de quick massage corporativa em ambiente de escritório"
                width={1536}
                height={1024}
                className="h-full w-full object-cover"
              />
            </div>
            <div className="absolute -bottom-6 -left-6 hidden rounded-2xl border border-sage/10 bg-cream p-5 shadow-xl md:block fade-up-delay-2">
              <div className="flex items-center gap-3">
                <div className="grid h-10 w-10 place-items-center rounded-full bg-sage/10 text-sage">
                  <Heart size={18} />
                </div>
                <div>
                  <p className="text-xs uppercase tracking-wider text-muted-foreground">+ saúde corporativa</p>
                  <p className="text-sm font-semibold text-sage-deep">15 min que renovam</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* SOBRE */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-2 md:items-center lg:px-10">
          <div className="relative">
            <div className="overflow-hidden rounded-2xl bg-cream">
              <img src={zenImg} alt="Equilíbrio e elementos naturais" loading="lazy" className="aspect-[4/5] w-full object-cover" />
            </div>
          </div>
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Sobre a Godai</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Equilíbrio entre corpo, mente e ambiente.
            </h2>
            <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground">
              <p>
                A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio,
                acolhimento e bem-estar através das terapias corporais.
              </p>
              <p>
                Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Éter —
                a marca traduz harmonia entre corpo, mente e ambiente.
              </p>
              <p>
                Atuamos com Quick Massage Corporativa levando experiências de relaxamento e
                qualidade de vida diretamente às empresas, contribuindo para ambientes mais
                saudáveis, produtivos e humanos.
              </p>
            </div>

            <div className="mt-10 grid grid-cols-5 gap-3">
              {ELEMENTS.map(({ icon: Icon, label }) => (
                <div key={label} className="flex flex-col items-center gap-2 rounded-xl border border-sage/10 bg-cream/50 p-3 transition-colors hover:border-sage/30 hover:bg-cream">
                  <Icon size={20} className="text-sage" />
                  <span className="text-[11px] tracking-wide text-sage-deep">{label}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* BENEFÍCIOS */}
      <section className="bg-sage py-20 text-cream md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">Para sua empresa</span>
            <h2 className="mt-4 text-3xl md:text-4xl">Benefícios que se sentem em todo o ambiente.</h2>
            <p className="mt-4 text-cream/80">
              Mais que uma massagem: uma experiência de cuidado que reflete em produtividade,
              clima e engajamento.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {BENEFITS.map((b) => (
              <div key={b} className="group flex items-start gap-3 rounded-xl border border-cream/15 bg-cream/5 p-5 transition-colors hover:bg-cream/10">
                <span className="mt-0.5 grid h-6 w-6 place-items-center rounded-full bg-cream/15">
                  <Check size={14} />
                </span>
                <p className="text-sm text-cream/95">{b}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* TABELA DE PREÇOS */}
      <section className="bg-cream py-20 md:py-28" id="planos">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Planos</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Tabela de atendimento</h2>
            <p className="mx-auto mt-4 max-w-xl text-muted-foreground">
              Formatos pensados para diferentes tamanhos de equipe e durações de evento.
            </p>
          </div>

          <div className="mt-12 overflow-hidden rounded-2xl border border-sage/10 bg-white shadow-sm">
            <div className="hidden grid-cols-5 gap-4 border-b border-sage/10 bg-sage/5 px-6 py-4 text-xs font-semibold uppercase tracking-wider text-sage-deep md:grid">
              <div>Tempo</div>
              <div>1 Terapeuta</div>
              <div>Capacidade</div>
              <div>2 Terapeutas</div>
              <div>Capacidade</div>
            </div>
            {PRICING.map((row) => (
              <div key={row.time} className="grid grid-cols-2 gap-y-2 border-b border-sage/5 px-6 py-5 text-sm last:border-0 md:grid-cols-5 md:items-center md:gap-4">
                <div className="md:col-span-1">
                  <p className="text-xs uppercase tracking-wider text-muted-foreground md:hidden">Tempo</p>
                  <p className="text-2xl font-bold text-sage md:text-xl">{row.time}</p>
                </div>
                <div>
                  <p className="text-xs uppercase tracking-wider text-muted-foreground md:hidden">1 Terapeuta</p>
                  <p className="font-semibold text-sage-deep">{row.solo}</p>
                </div>
                <div className="text-muted-foreground">
                  <p className="text-xs uppercase tracking-wider md:hidden">Capacidade</p>
                  {row.soloCap}
                </div>
                <div>
                  <p className="text-xs uppercase tracking-wider text-muted-foreground md:hidden">2 Terapeutas</p>
                  <p className="font-semibold text-sage-deep">{row.duo}</p>
                </div>
                <div className="text-muted-foreground">
                  <p className="text-xs uppercase tracking-wider md:hidden">Capacidade</p>
                  {row.duoCap}
                </div>
              </div>
            ))}
          </div>
          <p className="mt-4 text-center text-xs text-muted-foreground">
            Valores corporativos para atendimento in company com emissão de Nota Fiscal.
          </p>

          <div className="mt-10 text-center">
            <Link
              to="/contato"
              className="inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream transition-all hover:bg-sage-deep"
            >
              Solicitar orçamento personalizado <ArrowRight size={16} />
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
