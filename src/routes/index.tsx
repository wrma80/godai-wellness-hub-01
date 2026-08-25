import { createFileRoute, Link } from "@tanstack/react-router";
import { ArrowRight, Sparkles, Heart, Leaf, Wind, Flame, Mountain, Droplets, Check, Globe2, HandHeart, Package, GraduationCap, Building2, Award } from "lucide-react";
import heroImg from "@/assets/hero-massage.jpg";
import zenImg from "@/assets/about-zen.jpg";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

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
  { icon: Sparkles, label: "Vazio" },
];

const BENEFITS = [
  "Redução do estresse",
  "Melhora do clima organizacional",
  "Valorização dos colaboradores",
  "Aumento do bem-estar",
  "Ações de qualidade de vida",
  "Experiência corporativa diferenciada",
];

const DIFERENCIAIS = [
  { icon: Award, text: "20+ anos de expertise" },
  { icon: Globe2, text: "Experiência internacional" },
  { icon: GraduationCap, text: "Profissionais qualificados" },
  { icon: Building2, text: "Experiência corporativa premium" },
  { icon: Package, text: "Estrutura completa inclusa" },
  { icon: HandHeart, text: "Atendimento humanizado" },
];

const PLANOS = [
  {
    title: "Ação Pontual",
    subtitle: "Sob Demanda",
    desc: "Perfeito para SIPAT, eventos internos e campanhas de bem-estar.",
    items: [
      "Agendamento único",
      "Ideal para ações pontuais",
      "Ideal para datas comemorativas",
      "Contratação por período de atendimento",
    ],
  },
  {
    title: "Plano Corporativo",
    subtitle: "Parceria Estratégica",
    desc: "Programa contínuo de bem-estar para empresas com visão de longo prazo.",
    items: [
      "Atendimento recorrente",
      "Planejamento contínuo das ações",
      "Organização do calendário corporativo",
      "Programa estruturado de qualidade de vida",
    ],
  },
];


function HomePage() {
  const { data: settings } = useSettings();
  const s = settings ?? DEFAULT_SETTINGS;
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
              A Godai Terapias Integrativas leva experiências de bem-estar para empresas que
              desejam valorizar pessoas, fortalecer ações de qualidade de vida e promover
              ambientes corporativos mais saudáveis.
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
                href={buildWhatsappLink(s)}
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
            <div className="absolute -bottom-6 -left-6 hidden rounded-2xl border border-sage/10 bg-cream p-5 shadow-xl md:block fade-in-delay-2">
              <div className="flex items-center gap-3">
                <div className="grid h-10 w-10 place-items-center rounded-full bg-sage/10 text-sage">
                  <Heart size={18} />
                </div>
                <div>
                  <p className="text-xs uppercase tracking-wider text-muted-foreground">Saúde corporativa</p>
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
                A Godai Terapias Integrativas nasceu com o propósito de promover equilíbrio,
                acolhimento e bem-estar através das terapias corporais.
              </p>
              <p>
                Inspirada no conceito oriental dos cinco elementos — Terra, Água, Fogo, Ar e Vazio —
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
                  <Icon size={20} className="text-sage" strokeWidth={1.5} />
                  <span className="text-[11px] tracking-wide text-sage-deep">{label}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* PARA SUA EMPRESA */}
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
                  <Check size={14} strokeWidth={1.75} />
                </span>
                <p className="text-sm text-cream/95">{b}</p>
              </div>
            ))}
          </div>

          <div className="mx-auto mt-14 max-w-2xl rounded-2xl border border-cream/20 bg-cream/5 p-8 text-center md:p-10">
            <h3 className="text-xl text-cream md:text-2xl">
              Quer entender como a Quick Massage pode gerar valor para sua empresa?
            </h3>
            <p className="mt-4 text-sm leading-relaxed text-cream/80">
              Descubra como ações de bem-estar podem contribuir para a qualidade de vida dos
              colaboradores, fortalecer programas internos, apoiar iniciativas relacionadas à
              NR-1 e agregar valor às ações corporativas.
            </p>
            <Link
              to="/beneficios"
              className="mt-6 inline-flex items-center gap-2 rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]"
            >
              Conhecer os benefícios para empresas <ArrowRight size={16} />
            </Link>
          </div>
        </div>
      </section>

      {/* DIFERENCIAIS */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Diferenciais</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Por que escolher a Godai.</h2>
            <p className="mt-4 text-muted-foreground">
              Cuidado, estrutura e experiência corporativa premium em todos os atendimentos.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {DIFERENCIAIS.map(({ icon: Icon, text }) => (
              <div key={text} className="group flex items-start gap-3 rounded-xl border border-sage/15 bg-cream/40 p-5 transition-colors hover:border-sage/30 hover:bg-cream">
                <span className="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={18} strokeWidth={1.5} />
                </span>
                <p className="pt-1 text-sm text-sage-deep">{text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* FORMAS DE CONTRATAÇÃO */}
      <section id="formas-contratacao" className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Formas de Contratação</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Escolha o formato ideal para sua empresa</h2>
            <p className="mx-auto mt-4 max-w-xl text-muted-foreground">
              Três modalidades pensadas para diferentes momentos e necessidades corporativas.
            </p>
          </div>

          <div className="mt-12 grid gap-6 md:grid-cols-3">
            {PLANOS.map((p, i) => (
              <div
                key={p.title}
                className={`relative flex flex-col rounded-2xl border bg-white p-8 shadow-sm transition-all hover:shadow-md ${
                  i === 1 ? "border-sage/40 ring-1 ring-sage/30" : "border-sage/10"
                }`}
              >
                <h3 className="text-center text-2xl text-sage-deep">{p.title}</h3>
                <span className="mt-3 block text-center text-xs font-semibold uppercase tracking-[0.2em] text-sage">{p.subtitle}</span>
                <p className="mt-3 text-center text-sm text-muted-foreground">{p.desc}</p>
                <ul className="mt-6 space-y-3 text-sm">
                  {p.items.map((it) => (
                    <li key={it} className="flex items-start gap-2 text-sage-deep">
                      <Check size={16} className="mt-0.5 text-sage" strokeWidth={1.75} />
                      <span>{it}</span>
                    </li>
                  ))}
                </ul>
                <Link
                  to="/contato"
                  className="mt-8 inline-flex items-center justify-center gap-2 rounded-full border border-sage/30 px-5 py-2.5 text-sm font-medium text-sage-deep transition-all hover:border-sage hover:bg-sage/5"
                >
                  Solicitar orçamento <ArrowRight size={14} />
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA FINAL */}
      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">
            Vamos construir uma experiência de bem-estar para a sua equipe?
          </h2>
          <Link
            to="/contato"
            className="mt-8 inline-flex items-center gap-2 rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]"
          >
            Solicitar orçamento <ArrowRight size={16} />
          </Link>
        </div>
      </section>
    </>
  );
}
