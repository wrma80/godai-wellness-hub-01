import { createFileRoute, Link } from "@tanstack/react-router";
import {
  ArrowRight, Check, Zap, Brain, Activity, TrendingUp, Armchair, MessageCircleHeart,
  Heart, Award, Flame, HeartHandshake, Building2, Sparkles, Users, PartyPopper,
  Calendar, Target, GraduationCap, ShieldCheck, Ribbon,
} from "lucide-react";
import heroImg from "@/assets/hero-massage.jpg";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/beneficios")({
  head: () => ({
    meta: [
      { title: "Benefícios da Quick Massage Corporativa | Godai Terapias Integrativas" },
      { name: "description", content: "Descubra como a Quick Massage Corporativa pode contribuir para o bem-estar dos colaboradores, ações de qualidade de vida, SIPAT e programas corporativos." },
      { name: "keywords", content: "quick massage corporativa, bem-estar corporativo, qualidade de vida no trabalho, sipat, saúde ocupacional, nr1, riscos psicossociais, massagem para empresas, qualidade de vida empresarial, saúde mental corporativa" },
      { property: "og:title", content: "Benefícios da Quick Massage Corporativa | Godai Terapias Integrativas" },
      { property: "og:description", content: "Bem-estar corporativo que valoriza pessoas e fortalece ações de qualidade de vida." },
      { property: "og:url", content: "https://godai-zen-space.lovable.app/beneficios" },
    ],
    links: [{ rel: "canonical", href: "https://godai-zen-space.lovable.app/beneficios" }],
  }),
  component: BeneficiosPage,
});

const DESAFIOS = [
  { icon: Zap, label: "Estresse diário" },
  { icon: MessageCircleHeart, label: "Sobrecarga emocional" },
  { icon: Activity, label: "Tensão muscular" },
  { icon: Brain, label: "Fadiga mental" },
  { icon: TrendingUp, label: "Pressão por resultados" },
  { icon: Armchair, label: "Sedentarismo ocupacional" },
];

const BENEFICIOS_QM = [
  "Relaxamento imediato",
  "Alívio de tensões musculares",
  "Sensação de bem-estar",
  "Redução do estresse",
  "Recuperação da disposição",
  "Pausa saudável durante a jornada",
];

const VALORIZACAO = [
  { icon: HeartHandshake, label: "Valorização das pessoas" },
  { icon: Award, label: "Reconhecimento interno" },
  { icon: Flame, label: "Engajamento" },
  { icon: Heart, label: "Bem-estar emocional" },
  { icon: Building2, label: "Cultura organizacional" },
  { icon: Sparkles, label: "Experiência do colaborador" },
];

const NR1 = [
  "Estresse ocupacional",
  "Sobrecarga emocional",
  "Fadiga mental",
  "Pressão excessiva",
  "Clima organizacional",
  "Qualidade de vida",
];

const APLICACOES = [
  { icon: Building2, label: "Programas de qualidade de vida" },
  { icon: ShieldCheck, label: "SIPAT" },
  { icon: Ribbon, label: "Outubro Rosa" },
  { icon: Ribbon, label: "Novembro Azul" },
  { icon: PartyPopper, label: "Datas comemorativas" },
  { icon: Target, label: "Campanhas de endomarketing" },
  { icon: Calendar, label: "Eventos corporativos" },
  { icon: Users, label: "Integração de equipes" },
  { icon: Award, label: "Reconhecimento de colaboradores" },
  { icon: GraduationCap, label: "Treinamentos e convenções" },
];

const ESTRUTURA = [
  "Cadeira profissional",
  "Terapeutas qualificados",
  "Organização dos atendimentos",
  "Materiais inclusos",
  "Atendimento personalizado",
  "Estrutura completa",
];

const MODELOS = [
  { title: "Contratação Avulsa", desc: "Ideal para SIPAT, eventos internos, campanhas corporativas e datas comemorativas." },
  { title: "Pacote Corporativo", desc: "Ideal para múltiplas ações ao longo do ano, campanhas periódicas e empresas que desejam flexibilidade." },
  { title: "Programa Corporativo", desc: "Ideal para ações recorrentes, calendário anual de bem-estar e programas estruturados de qualidade de vida." },
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
              A Quick Massage Corporativa é uma solução prática e eficiente para promover
              bem-estar, aliviar tensões e fortalecer ações de qualidade de vida dentro das
              organizações.
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

      {/* DESAFIOS */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Desafios Corporativos</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              As pessoas enfrentam cada vez mais pressão no ambiente de trabalho
            </h2>
            <p className="mt-4 text-muted-foreground">
              A rotina corporativa moderna apresenta diversos fatores que impactam o bem-estar dos colaboradores.
            </p>
            <p className="mt-3 text-muted-foreground">
              Longos períodos sentados, excesso de demandas, pressão por resultados e altos níveis de estresse podem afetar a qualidade de vida e a experiência dentro da empresa.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {DESAFIOS.map(({ icon: Icon, label }) => (
              <div key={label} className="flex items-start gap-3 rounded-xl border border-sage/15 bg-cream/40 p-5 transition-colors hover:border-sage/30 hover:bg-cream">
                <span className="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={18} strokeWidth={1.5} />
                </span>
                <p className="pt-1 text-sm text-sage-deep">{label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* SOLUÇÃO */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Solução</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Pequenas pausas que geram grandes resultados
            </h2>
            <p className="mt-4 text-muted-foreground">
              Em poucos minutos, a Quick Massage proporciona relaxamento, conforto e uma pausa saudável durante a rotina corporativa.
            </p>
            <p className="mt-3 text-muted-foreground">
              É uma ação simples, de rápida implementação e com alta aceitação entre os colaboradores.
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

      {/* VALORIZAÇÃO */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Pessoas</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Demonstre cuidado com quem faz sua empresa acontecer
            </h2>
            <p className="mt-4 text-muted-foreground">
              Quando a empresa investe em iniciativas voltadas ao bem-estar, os colaboradores percebem o cuidado da organização com sua qualidade de vida.
            </p>
            <p className="mt-3 text-muted-foreground">
              Essa percepção fortalece vínculos e contribui para uma experiência mais positiva no ambiente corporativo.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {VALORIZACAO.map(({ icon: Icon, label }) => (
              <div key={label} className="flex items-start gap-3 rounded-xl border border-sage/15 bg-cream/40 p-5 transition-colors hover:border-sage/30 hover:bg-cream">
                <span className="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={18} strokeWidth={1.5} />
                </span>
                <p className="pt-1 text-sm text-sage-deep">{label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* NR-1 */}
      <section className="bg-sage py-20 text-cream md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-3xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">Adequação Corporativa</span>
            <h2 className="mt-4 text-3xl md:text-4xl">
              A importância do bem-estar diante das novas exigências da NR-1
            </h2>
            <p className="mt-4 text-cream/85">
              A atualização da NR-1 ampliou a atenção aos riscos psicossociais presentes nas organizações.
            </p>
            <p className="mt-3 text-cream/80">
              Questões relacionadas ao estresse, sobrecarga emocional e fatores que impactam a saúde mental passaram a receber maior atenção dentro dos programas de gestão ocupacional. A Quick Massage pode complementar iniciativas voltadas ao bem-estar e qualidade de vida dos colaboradores.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {NR1.map((n) => (
              <div key={n} className="flex items-start gap-3 rounded-xl border border-cream/15 bg-cream/5 p-5">
                <span className="mt-0.5 grid h-6 w-6 place-items-center rounded-full bg-cream/15">
                  <Check size={14} strokeWidth={1.75} />
                </span>
                <p className="text-sm text-cream/95">{n}</p>
              </div>
            ))}
          </div>
          <p className="mt-10 max-w-3xl text-xs italic leading-relaxed text-cream/70">
            A Quick Massage não substitui programas obrigatórios de saúde ocupacional, mas pode complementar ações de promoção do bem-estar e qualidade de vida.
          </p>
        </div>
      </section>

      {/* APLICAÇÕES */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Aplicações</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Onde a Quick Massage pode ser aplicada
            </h2>
            <p className="mt-4 text-muted-foreground">
              A flexibilidade da Quick Massage permite sua utilização em diferentes momentos e ações corporativas.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
            {APLICACOES.map(({ icon: Icon, label }) => (
              <div key={label} className="flex flex-col items-center gap-3 rounded-xl border border-sage/15 bg-cream/40 p-5 text-center transition-colors hover:border-sage/30 hover:bg-cream">
                <span className="grid h-10 w-10 place-items-center rounded-full bg-sage/10 text-sage">
                  <Icon size={20} strokeWidth={1.5} />
                </span>
                <p className="text-sm text-sage-deep">{label}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ESTRUTURA */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="max-w-2xl">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Estrutura completa</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Implementação simples para sua empresa
            </h2>
            <p className="mt-4 text-muted-foreground">
              A Godai fornece toda a estrutura necessária para a realização dos atendimentos.
            </p>
            <p className="mt-3 text-muted-foreground">
              A empresa não precisa disponibilizar equipamentos ou infraestrutura específica.
            </p>
          </div>
          <div className="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            {ESTRUTURA.map((b) => (
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

      {/* MODELOS DE CONTRATAÇÃO */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="mx-auto max-w-2xl text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Contratação</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">
              Modelos flexíveis para diferentes necessidades
            </h2>
            <p className="mt-4 text-muted-foreground">
              A Godai oferece formatos de contratação que se adaptam tanto a ações pontuais quanto a programas contínuos de bem-estar corporativo.
            </p>
          </div>
          <div className="mt-12 grid gap-6 md:grid-cols-3">
            {MODELOS.map((m) => (
              <div key={m.title} className="rounded-2xl border border-sage/15 bg-cream/40 p-7">
                <h3 className="text-lg text-sage-deep">{m.title}</h3>
                <p className="mt-3 text-sm leading-relaxed text-muted-foreground">{m.desc}</p>
              </div>
            ))}
          </div>
          <div className="mt-10 text-center">
            <Link to="/" hash="planos" className="inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream shadow-sm transition-all hover:bg-sage-deep hover:shadow-md">
              Conheça os formatos de contratação <ArrowRight size={16} />
            </Link>
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
