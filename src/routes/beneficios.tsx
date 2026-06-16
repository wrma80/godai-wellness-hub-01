import { createFileRoute, Link } from "@tanstack/react-router";
import { ArrowRight, Check, Building2, Sparkles } from "lucide-react";
import heroImg from "@/assets/hero-massage.jpg";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/beneficios")({
  head: () => ({
    meta: [
      { title: "Benefícios da Quick Massage Corporativa | Godai Terapias Integrativas" },
      { name: "description", content: "Descubra como a Quick Massage Corporativa pode contribuir para o bem-estar dos colaboradores, ações de qualidade de vida, SIPAT e programas corporativos." },
      { name: "keywords", content: "quick massage corporativa, bem-estar corporativo, qualidade de vida no trabalho, sipat, saúde ocupacional, nr1, riscos psicossociais, massagem para empresas" },
      { property: "og:title", content: "Benefícios da Quick Massage Corporativa | Godai Terapias Integrativas" },
      { property: "og:description", content: "Bem-estar corporativo que valoriza pessoas e fortalece ações de qualidade de vida." },
      { property: "og:url", content: "https://godai-zen-space.lovable.app/beneficios" },
    ],
    links: [{ rel: "canonical", href: "https://godai-zen-space.lovable.app/beneficios" }],
  }),
  component: BeneficiosPage,
});

const TIMELINE = [
  "Pressão por resultados",
  "Estresse ocupacional",
  "Sobrecarga emocional",
  "Queda no bem-estar",
  "Necessidade de ações de qualidade de vida",
];

const BENEFICIOS_QM = [
  "Relaxamento imediato",
  "Alívio de tensões musculares",
  "Sensação de bem-estar",
  "Redução do estresse",
  "Pausa saudável na rotina",
  "Recuperação da disposição",
];

const APLICACOES = [
  "SIPAT", "Semana da Saúde", "Outubro Rosa", "Novembro Azul",
  "Dia do Trabalhador", "Datas comemorativas", "Campanhas internas",
  "Endomarketing", "Integração de equipes", "Eventos corporativos",
  "Treinamentos", "Convenções",
];

const NR1 = [
  "Estresse ocupacional", "Sobrecarga emocional", "Fadiga mental",
  "Pressão excessiva", "Clima organizacional", "Qualidade de vida",
];

const STATS = [
  "Bem-estar", "Engajamento", "Valorização dos colaboradores",
  "Clima organizacional", "Experiência do colaborador", "Ações de qualidade de vida",
];

const ESTRUTURA = [
  "Cadeira profissional",
  "Terapeutas qualificados",
  "Organização dos atendimentos",
  "Materiais inclusos",
  "Atendimento personalizado",
  "Estrutura completa",
];

function BeneficiosPage() {
  const { data } = useSettings();
  const s = data ?? DEFAULT_SETTINGS;
  return (
    <>
      {/* HERO */}
      <section className="relative overflow-hidden">
        <div className="mx-auto grid max-w-7xl gap-12 px-6 py-16 md:grid-cols-2 md:items-center md:py-24 lg:px-10">
          <div className="fade-up">
            <span className="inline-flex items-center gap-2 rounded-full border border-sage/20 bg-cream px-4 py-1.5 text-xs font-medium tracking-wider text-sage uppercase">
              <Building2 size={12} /> Benefícios para Empresas
            </span>
            <h1 className="mt-6 text-4xl leading-[1.1] text-sage-deep md:text-5xl lg:text-6xl">
              Sua empresa cuida dos resultados. <em className="not-italic text-sage">Nós ajudamos a cuidar das pessoas.</em>
            </h1>
            <p className="mt-6 max-w-lg text-base leading-relaxed text-muted-foreground md:text-lg">
              A Quick Massage Corporativa é uma solução prática e eficiente para promover bem-estar, aliviar tensões e fortalecer ações de qualidade de vida dentro das organizações.
            </p>
            <p className="mt-4 max-w-lg text-base leading-relaxed text-muted-foreground">
              Investir nas pessoas é investir em um ambiente mais saudável, equilibrado e produtivo.
            </p>
            <div className="mt-8 flex flex-wrap gap-3">
              <Link to="/contato" className="group inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream shadow-sm transition-all hover:bg-sage-deep hover:shadow-md">
                Solicitar orçamento <ArrowRight size={16} className="transition-transform group-hover:translate-x-1" />
              </Link>
              <a href={buildWhatsappLink(s)} target="_blank" rel="noreferrer" className="inline-flex items-center gap-2 rounded-full border border-sage/30 px-6 py-3 text-sm font-medium text-sage-deep transition-all hover:border-sage hover:bg-sage/5">
                Falar no WhatsApp
              </a>
            </div>
          </div>
          <div className="relative fade-up-delay-1">
            <div className="absolute -inset-6 -z-10 rounded-[2rem] bg-sage/10 blur-3xl" />
            <div className="overflow-hidden rounded-2xl shadow-2xl">
              <img src={heroImg} alt="Terapeuta realizando Quick Massage em ambiente corporativo moderno" className="h-full w-full object-cover" />
            </div>
          </div>
        </div>
      </section>

      {/* 1 — TIMELINE: CENÁRIO */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Cenário corporativo</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">O cenário atual das empresas</h2>
            <p className="mt-4 text-muted-foreground">
              As organizações enfrentam desafios cada vez maiores relacionados ao bem-estar, saúde mental, engajamento e qualidade de vida dos colaboradores.
            </p>
          </div>
          <ol className="mx-auto mt-14 max-w-2xl border-l border-sage/25 pl-8">
            {TIMELINE.map((step, i) => (
              <li key={step} className="relative mb-10 last:mb-0">
                <span className="absolute -left-[42px] top-1 grid h-8 w-8 place-items-center rounded-full border border-sage/30 bg-cream text-xs font-semibold text-sage">
                  {String(i + 1).padStart(2, "0")}
                </span>
                <p className="text-lg font-medium text-sage-deep">{step}</p>
              </li>
            ))}
          </ol>
        </div>
      </section>

      {/* 2 — CARDS: COMO AJUDA */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Solução</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Como a Quick Massage ajuda</h2>
            <p className="mt-4 text-muted-foreground">
              Em poucos minutos, a Quick Massage proporciona relaxamento, conforto e uma pausa saudável durante a rotina corporativa.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {BENEFICIOS_QM.map((b) => (
              <div key={b} className="flex items-start gap-3 rounded-xl border border-sage/15 bg-white p-5">
                <span className="mt-0.5 grid h-6 w-6 place-items-center rounded-full bg-sage/10 text-sage">
                  <Check size={14} strokeWidth={1.75} />
                </span>
                <p className="text-sm text-sage-deep">{b}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 3 — TAGS: APLICAÇÕES */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Aplicações</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Onde a Quick Massage pode ser aplicada</h2>
            <p className="mt-4 text-muted-foreground">
              A flexibilidade da Quick Massage permite sua utilização em diferentes momentos e ações corporativas.
            </p>
          </div>
          <div className="mt-10 flex flex-wrap gap-3">
            {APLICACOES.map((t) => (
              <span key={t} className="inline-flex items-center rounded-full border border-sage/25 bg-cream/60 px-4 py-2 text-sm text-sage-deep transition-colors hover:border-sage hover:bg-cream">
                {t}
              </span>
            ))}
          </div>
        </div>
      </section>

      {/* 4 — DUAS COLUNAS: NR-1 */}
      <section className="bg-sage py-20 text-cream md:py-28">
        <div className="mx-auto grid max-w-7xl gap-12 px-6 lg:grid-cols-2 lg:px-10">
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">NR-1 e Riscos Psicossociais</span>
            <h2 className="mt-4 text-3xl md:text-4xl">A importância do bem-estar diante das exigências da NR-1</h2>
            <p className="mt-5 text-cream/85">
              A atualização da NR-1 ampliou a atenção aos riscos psicossociais presentes nas organizações.
            </p>
            <p className="mt-3 text-cream/80">
              Questões relacionadas ao estresse, sobrecarga emocional e fatores que impactam a saúde mental passaram a receber maior atenção dentro dos programas de gestão ocupacional. A Quick Massage pode complementar iniciativas voltadas ao bem-estar e qualidade de vida dos colaboradores.
            </p>
            <p className="mt-6 text-xs italic leading-relaxed text-cream/65">
              A Quick Massage não substitui programas obrigatórios de saúde ocupacional, mas pode complementar ações de bem-estar e qualidade de vida.
            </p>
          </div>
          <div className="grid gap-3 sm:grid-cols-2 self-center">
            {NR1.map((n) => (
              <div key={n} className="rounded-xl border border-cream/20 bg-cream/5 px-4 py-3 text-sm text-cream/95">
                {n}
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 5 — ESTATÍSTICAS */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Benefícios para a empresa</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Impactos percebidos no ambiente corporativo</h2>
          </div>
          <div className="mt-14 grid gap-x-10 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
            {STATS.map((s) => (
              <div key={s} className="border-t border-sage/20 pt-5">
                <div className="text-5xl font-light text-sage md:text-6xl">+</div>
                <p className="mt-3 text-lg font-medium text-sage-deep">{s}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 6 — CHECKLIST PREMIUM: ESTRUTURA */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-3xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Estrutura</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Estrutura completa fornecida pela Godai</h2>
            <p className="mt-4 text-muted-foreground">
              A Godai fornece toda a estrutura necessária para a realização dos atendimentos. A empresa não precisa disponibilizar equipamentos ou infraestrutura específica.
            </p>
          </div>
          <ul className="mt-12 divide-y divide-sage/15 rounded-2xl border border-sage/15 bg-white">
            {ESTRUTURA.map((b) => (
              <li key={b} className="flex items-center gap-4 px-6 py-5">
                <span className="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-sage text-cream">
                  <Check size={16} strokeWidth={2} />
                </span>
                <span className="text-base text-sage-deep">{b}</span>
              </li>
            ))}
          </ul>
        </div>
      </section>

      {/* 7 — BLOCO INSTITUCIONAL: CONTRATAÇÃO */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-5xl px-6 lg:px-10">
          <div className="relative overflow-hidden rounded-3xl border border-sage/20 bg-cream/50 p-10 text-center md:p-14">
            <Sparkles size={28} className="mx-auto text-sage" strokeWidth={1.5} />
            <span className="mt-4 inline-block text-xs font-semibold uppercase tracking-[0.25em] text-sage">Formas de contratação</span>
            <h2 className="mt-3 text-3xl text-sage-deep md:text-4xl">Escolha o formato ideal para sua empresa</h2>
            <p className="mx-auto mt-5 max-w-2xl text-muted-foreground">
              A Godai oferece diferentes modalidades de contratação — Avulso, Pacote Corporativo e Programa Corporativo — para atender desde ações pontuais até programas contínuos de qualidade de vida corporativa.
            </p>
            <div className="mt-8">
              <Link to="/" hash="planos" className="inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream shadow-sm transition-all hover:bg-sage-deep hover:shadow-md">
                Conhecer modalidades de contratação <ArrowRight size={16} />
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* CTA FINAL */}
      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">
            Vamos construir uma experiência de bem-estar para sua equipe?
          </h2>
          <p className="mx-auto mt-6 max-w-xl text-cream/85">
            Solicite um orçamento sem compromisso e descubra como a Quick Massage pode agregar valor às ações de qualidade de vida da sua empresa.
          </p>
          <div className="mt-8 flex flex-wrap justify-center gap-3">
            <Link to="/contato" className="inline-flex items-center gap-2 rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]">
              Solicitar orçamento <ArrowRight size={16} />
            </Link>
            <a href={buildWhatsappLink(s)} target="_blank" rel="noreferrer" className="inline-flex items-center gap-2 rounded-full border border-cream/40 px-6 py-3 text-sm font-medium text-cream transition-all hover:bg-cream/10">
              Falar no WhatsApp
            </a>
          </div>
        </div>
      </section>
    </>
  );
}
