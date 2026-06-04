import { createFileRoute, Link } from "@tanstack/react-router";
import { Mountain, Droplets, Flame, Wind, Sparkles, Award, Target, Eye, Heart, MapPin } from "lucide-react";
import zenImg from "@/assets/about-zen.jpg";

export const Route = createFileRoute("/sobre")({
  head: () => ({
    meta: [
      { title: "Sobre — Godai Terapias Integrativas" },
      { name: "description", content: "Conheça a história, missão, valores e equipe da Godai Terapias Integrativas — wellness corporativo humanizado." },
    ],
  }),
  component: SobrePage,
});

const ELEMENTS = [
  { icon: Mountain, label: "Terra", desc: "Estabilidade e enraizamento." },
  { icon: Droplets, label: "Água", desc: "Fluidez e adaptação." },
  { icon: Flame, label: "Fogo", desc: "Energia e transformação." },
  { icon: Wind, label: "Ar", desc: "Leveza e respiração." },
  { icon: Sparkles, label: "Vazio", desc: "Conexão e essência." },
];

const MVV = [
  {
    icon: Target,
    title: "Missão",
    text: "Promover experiências de bem-estar corporativo voltadas à qualidade de vida, equilíbrio e valorização das pessoas.",
  },
  {
    icon: Eye,
    title: "Visão",
    text: "Ser referência em wellness corporativo e experiências integrativas humanizadas.",
  },
  {
    icon: Heart,
    title: "Valores",
    text: "Cuidado com as pessoas, qualidade e excelência, ética e transparência, humanização dos ambientes corporativos.",
  },
];

function SobrePage() {
  return (
    <>
      {/* HERO INTERNO */}
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Sobre a Godai</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">
          Equilíbrio, acolhimento e bem-estar.
        </h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio,
          acolhimento e bem-estar através das terapias corporais. Inspirada no conceito
          oriental dos cinco elementos — Terra, Água, Fogo, Ar e Vazio — a marca traduz
          harmonia entre corpo, mente e ambiente.
        </p>
      </section>

      {/* NOSSA HISTÓRIA */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-2 md:items-start lg:px-10">
          <div className="overflow-hidden rounded-2xl">
            <img src={zenImg} alt="Equilíbrio e elementos naturais" loading="lazy" className="aspect-[4/5] w-full object-cover" />
          </div>
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Nossa história</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Uma trajetória feita de cuidado e propósito.</h2>
            <div className="mt-6 space-y-4 text-sm leading-relaxed text-muted-foreground md:text-base">
              <p>
                A GODAI Terapias Integrativas nasceu da união entre experiência terapêutica,
                vivência corporativa e propósito humano.
              </p>
              <p>
                A trajetória de Erica Aires nas terapias integrativas começou em 2001, com
                formação em Naturopatia, Shiatsu e Acupuntura, em São Paulo. Desde então, sua
                atuação sempre esteve voltada ao cuidado físico, emocional e ao desenvolvimento
                de experiências terapêuticas humanizadas.
              </p>
              <p>
                Ao longo dos anos, Erica atuou em atendimentos domiciliares, clínicas, quiosques
                e espaços especializados em Quick Massage, além de desenvolver trabalhos em
                empresas e ambientes corporativos. Sua trajetória também inclui experiências
                internacionais no Japão, México e especializações em Chiang Mai, na Tailândia
                — referência mundial em terapias tradicionais e massagem tailandesa.
              </p>
              <p>
                Foi justamente a vivência no Japão, em ambientes industriais e de alta exigência
                física e emocional, que fortaleceu a percepção sobre a importância do bem-estar
                dentro das organizações.
              </p>
              <p>
                Nesse processo, Wellington Aires passou a integrar o projeto, contribuindo com
                sua experiência em ambientes corporativos e industriais, além da formação em
                Quick Massage pelo Senac. Sua atuação trouxe uma visão estratégica voltada à
                estruturação dos atendimentos corporativos, organização operacional e
                desenvolvimento da experiência oferecida às empresas.
              </p>
              <p>
                Da união dessas experiências nasceu a GODAI Terapias Integrativas: uma empresa
                criada para promover qualidade de vida, equilíbrio e valorização humana dentro
                das organizações.
              </p>
              <p>
                Inspirada nos cinco elementos da filosofia japonesa — Terra, Água, Fogo, Ar e
                Vazio — a GODAI acredita que ambientes mais saudáveis geram pessoas mais
                engajadas, produtivas e equilibradas.
              </p>
              <p>
                Hoje, a empresa atua levando experiências de bem-estar corporativo através da
                Quick Massage e de abordagens integrativas voltadas à redução do estresse,
                alívio de tensões e promoção da qualidade de vida no ambiente de trabalho.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* CINCO ELEMENTOS */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Filosofia</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Os cinco elementos</h2>
            <p className="mt-4 text-muted-foreground">
              Cada elemento carrega uma força que inspira a forma como cuidamos do outro.
              Juntos, formam o nome e a essência da Godai.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            {ELEMENTS.map(({ icon: Icon, label, desc }) => (
              <div key={label} className="rounded-2xl border border-sage/10 bg-white p-6 text-center transition-all hover:border-sage/30 hover:shadow-sm">
                <div className="mx-auto grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={22} strokeWidth={1.5} />
                </div>
                <p className="mt-4 text-base font-semibold text-sage-deep">{label}</p>
                <p className="mt-2 text-xs text-muted-foreground">{desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* MISSÃO VISÃO VALORES */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Identidade</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Missão, Visão e Valores</h2>
          </div>
          <div className="mt-12 grid gap-6 md:grid-cols-3">
            {MVV.map(({ icon: Icon, title, text }) => (
              <div key={title} className="rounded-2xl border border-sage/10 bg-cream/40 p-8 transition-all hover:border-sage/30 hover:bg-cream">
                <div className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={22} strokeWidth={1.5} />
                </div>
                <h3 className="mt-5 text-xl text-sage-deep">{title}</h3>
                <p className="mt-3 text-sm leading-relaxed text-muted-foreground">{text}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CERTIFICAÇÕES */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-5xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Certificações</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Formação e especializações</h2>
          </div>
          <div className="mt-12 grid gap-6 md:grid-cols-2">
            <div className="rounded-2xl border border-sage/10 bg-white p-8">
              <div className="flex items-center gap-3">
                <Award size={20} className="text-sage" strokeWidth={1.5} />
                <h3 className="text-xl text-sage-deep">Erica Aires</h3>
              </div>
              <ul className="mt-5 space-y-2 text-sm text-muted-foreground">
                {["Naturopatia","Shiatsu","Acupuntura","Bambuterapia","Thai Table Massage","Reflexologia","Foot Massage"].map(c => (
                  <li key={c} className="flex items-center gap-2"><span className="h-1 w-1 rounded-full bg-sage"/>{c}</li>
                ))}
              </ul>
            </div>
            <div className="rounded-2xl border border-sage/10 bg-white p-8">
              <div className="flex items-center gap-3">
                <Award size={20} className="text-sage" strokeWidth={1.5} />
                <h3 className="text-xl text-sage-deep">Wellington Aires</h3>
              </div>
              <ul className="mt-5 space-y-2 text-sm text-muted-foreground">
                <li className="flex items-center gap-2"><span className="h-1 w-1 rounded-full bg-sage"/>Formação em Quick Massage — Senac</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* REGIÃO DE ATENDIMENTO */}
      <section className="bg-white py-16">
        <div className="mx-auto max-w-4xl px-6 text-center lg:px-10">
          <div className="mx-auto grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
            <MapPin size={22} strokeWidth={1.5} />
          </div>
          <h2 className="mt-5 text-2xl text-sage-deep md:text-3xl">Região de atendimento</h2>
          <p className="mt-3 text-muted-foreground">
            Indaiatuba/SP — demais regiões mediante consulta.
          </p>
        </div>
      </section>

      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">Pronto para levar bem-estar à sua empresa?</h2>
          <Link
            to="/contato"
            className="mt-8 inline-flex rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]"
          >
            Solicitar orçamento
          </Link>
        </div>
      </section>
    </>
  );
}
