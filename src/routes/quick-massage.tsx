import { createFileRoute, Link } from "@tanstack/react-router";
import { Check, ArrowRight, Clock, Briefcase, Factory, Users, Stethoscope, CalendarDays, PartyPopper, Calendar, Wrench, HandHeart, Sparkles, Info, ChevronRight } from "lucide-react";
import sessionImg from "@/assets/quick-massage-session.jpg";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/quick-massage")({
  head: () => ({
    meta: [
      { title: "Quick Massage Corporativa — Godai Terapias Integrativas" },
      { name: "description", content: "Quick Massage in company: sessões de 10 a 15 minutos com cadeira ergonômica para alívio de tensões e bem-estar dos colaboradores." },
    ],
  }),
  component: QuickMassagePage,
});

const PROCESSO = [
  {
    num: "01",
    icon: Calendar,
    title: "Agendamento",
    text: "A empresa define a data, horário e quantidade de colaboradores que participarão da ação.",
  },
  {
    num: "02",
    icon: Wrench,
    title: "Montagem",
    text: "A equipe da Godai realiza toda a preparação necessária no local, levando a estrutura de atendimento e organizando o espaço para a realização das sessões.",
  },
  {
    num: "03",
    icon: HandHeart,
    title: "Atendimento",
    text: "Sessões de Quick Massage de 10 a 15 minutos por colaborador, focadas em ombros, costas e braços, proporcionando alívio imediato das tensões musculares.",
  },
  {
    num: "04",
    icon: Sparkles,
    title: "Resultado",
    text: "Colaboradores mais relaxados, valorizados e engajados, contribuindo para um ambiente corporativo mais saudável.",
  },
];

const BENEFICIOS = [
  "Redução do estresse",
  "Relaxamento muscular",
  "Melhora da circulação",
  "Mais disposição",
  "Bem-estar corporativo",
  "Qualidade de vida",
];
const EMPRESAS = [
  { icon: Briefcase, label: "Escritórios" },
  { icon: Factory, label: "Indústrias" },
  { icon: Users, label: "Coworkings" },
  { icon: Stethoscope, label: "Clínicas" },
  { icon: CalendarDays, label: "SIPAT" },
  { icon: PartyPopper, label: "Eventos corporativos" },
];

function QuickMassagePage() {
  const { data: settings } = useSettings();
  const s = settings ?? DEFAULT_SETTINGS;
  return (
    <>
      {/* HERO */}
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Quick Massage</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">
          Quick Massage Corporativa
        </h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          Experiências voltadas à redução do estresse, alívio de tensões musculares e
          promoção da qualidade de vida no ambiente corporativo.
        </p>
        <Link
          to="/contato"
          className="mt-8 inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream transition-all hover:bg-sage-deep"
        >
          Solicitar orçamento <ArrowRight size={16} />
        </Link>
      </section>

      {/* O QUE É */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-2 md:items-center lg:px-10">
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">O que é</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">O que é a Quick Massage</h2>
            <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground">
              <p>
                A Quick Massage é uma técnica de massoterapia focada no alívio rápido de
                tensões musculares, realizada em cadeira ergonômica especialmente desenvolvida
                para proporcionar conforto e praticidade.
              </p>
              <p>
                Com sessões de 10 a 15 minutos, o atendimento é realizado com o colaborador
                sentado e vestido, tornando a experiência prática, eficiente e ideal para o
                ambiente corporativo.
              </p>
            </div>
          </div>
          <div className="overflow-hidden rounded-2xl shadow-xl">
            <img src={sessionImg} alt="Sessão de Quick Massage corporativa em escritório" loading="lazy" width={1536} height={1024} className="aspect-[4/3] w-full object-cover" />
          </div>
        </div>
      </section>

      {/* COMO FUNCIONA / PROCESSO */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Processo</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Como funciona</h2>
            <p className="mt-4 text-muted-foreground">
              Da solicitação ao resultado: quatro etapas para uma experiência simples,
              fluida e eficiente.
            </p>
          </div>

          <div className="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4 lg:gap-4">
            {PROCESSO.map((p, idx) => (
              <div key={p.num} className="relative flex flex-col rounded-2xl border border-sage/10 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                <div className="flex items-center gap-3">
                  <span className="grid h-11 w-11 place-items-center rounded-full bg-sage/10 text-sage">
                    <p.icon size={20} strokeWidth={1.5} />
                  </span>
                  <span className="text-2xl font-light text-sage/60">{p.num}</span>
                </div>
                <h3 className="mt-5 text-lg font-semibold text-sage-deep">{p.title}</h3>
                <p className="mt-3 text-sm leading-relaxed text-muted-foreground">{p.text}</p>
                {idx < PROCESSO.length - 1 && (
                  <ChevronRight
                    size={22}
                    className="absolute -right-3 top-1/2 hidden -translate-y-1/2 text-sage/40 lg:block"
                    aria-hidden="true"
                  />
                )}
              </div>
            ))}
          </div>

          <div className="mx-auto mt-12 flex max-w-3xl items-start gap-4 rounded-2xl border border-sage/20 bg-white p-6 shadow-sm">
            <span className="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
              <Info size={18} strokeWidth={1.75} />
            </span>
            <div>
              <p className="text-base font-semibold text-sage-deep">Não é necessário trocar de roupa.</p>
              <p className="mt-2 text-sm leading-relaxed text-muted-foreground">
                O atendimento é realizado diretamente na cadeira ergonômica de massagem,
                de forma rápida, discreta e eficiente, sem impactar a rotina de trabalho.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* BENEFÍCIOS */}
      <section className="bg-sage py-20 text-cream md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">Benefícios</span>
            <h2 className="mt-4 text-3xl md:text-4xl">Principais benefícios</h2>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {BENEFICIOS.map((b) => (
              <div key={b} className="flex items-start gap-3 rounded-xl border border-cream/15 bg-cream/5 p-5">
                <Check size={16} className="mt-0.5 shrink-0" strokeWidth={1.75} />
                <p className="text-sm text-cream/95">{b}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* PARA QUAIS EMPRESAS */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Indicações</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Para quais empresas é indicado</h2>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {EMPRESAS.map(({ icon: Icon, label }) => (
              <div key={label} className="flex items-center gap-4 rounded-2xl border border-sage/10 bg-cream/40 p-6">
                <span className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={20} strokeWidth={1.5} />
                </span>
                <p className="text-base font-medium text-sage-deep">{label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* EXPERIÊNCIA CORPORATIVA */}
      <section className="bg-cream py-20">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Experiência corporativa</span>
          <p className="mt-6 text-lg leading-relaxed text-sage-deep md:text-xl">
            Atendimento pensado para empresas que valorizam o bem-estar, a experiência dos
            colaboradores e um ambiente corporativo mais saudável e humanizado.
          </p>
        </div>
      </section>

      {/* CTA */}
      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">Leve mais bem-estar e qualidade de vida para sua empresa.</h2>
          <div className="mt-8 flex flex-wrap justify-center gap-3">
            <Link to="/contato" className="inline-flex items-center gap-2 rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]">
              Solicitar orçamento <ArrowRight size={16} />
            </Link>
            <a href={buildWhatsappLink(s)} target="_blank" rel="noreferrer" className="inline-flex items-center gap-2 rounded-full border border-cream/40 px-6 py-3 text-sm font-medium text-cream hover:bg-cream/10">
              Falar no WhatsApp
            </a>
          </div>
        </div>
      </section>
    </>
  );
}
