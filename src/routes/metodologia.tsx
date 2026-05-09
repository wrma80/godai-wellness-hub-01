import { createFileRoute, Link } from "@tanstack/react-router";
import { Handshake, ClipboardList, CalendarDays, Building2, Sparkles } from "lucide-react";

export const Route = createFileRoute("/metodologia")({
  head: () => ({
    meta: [
      { title: "Metodologia — Como funciona | Godai" },
      { name: "description", content: "Etapas para levar a Quick Massage Corporativa até a sua empresa, do alinhamento ao atendimento." },
    ],
  }),
  component: MetodologiaPage,
});

const STEPS = [
  { icon: Handshake, title: "Alinhamento com a empresa", desc: "Entendemos o objetivo, o público e o contexto da ação." },
  { icon: ClipboardList, title: "Definição do formato", desc: "Escolha do tempo, número de terapeutas e estrutura ideal." },
  { icon: CalendarDays, title: "Organização da agenda", desc: "Agendamentos otimizados para máxima participação." },
  { icon: Building2, title: "Atendimento in company", desc: "Equipe, cadeiras e materiais entregues e montados no local." },
  { icon: Sparkles, title: "Experiência de relaxamento", desc: "Bem-estar imediato e impacto no clima organizacional." },
];

function MetodologiaPage() {
  return (
    <>
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Metodologia</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">Como funciona</h1>
        <p className="mt-6 text-muted-foreground md:text-lg">
          Um processo simples, fluido e cuidadosamente desenhado para que a sua empresa
          viva uma experiência de bem-estar do começo ao fim.
        </p>
      </section>

      <section className="bg-white pb-24">
        <div className="mx-auto max-w-3xl px-6 lg:px-10">
          <ol className="relative space-y-10 border-l border-sage/20 pl-8">
            {STEPS.map(({ icon: Icon, title, desc }, i) => (
              <li key={title} className="relative">
                <span className="absolute -left-[2.55rem] grid h-10 w-10 place-items-center rounded-full border border-sage/20 bg-cream text-sage">
                  <Icon size={18} />
                </span>
                <div className="rounded-xl border border-sage/10 bg-cream/40 p-6">
                  <p className="text-xs font-semibold uppercase tracking-wider text-sage">Etapa {i + 1}</p>
                  <h3 className="mt-2 text-xl font-semibold text-sage-deep">{title}</h3>
                  <p className="mt-2 text-sm text-muted-foreground">{desc}</p>
                </div>
              </li>
            ))}
          </ol>

          <div className="mt-16 text-center">
            <Link
              to="/contato"
              className="inline-flex rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream hover:bg-sage-deep"
            >
              Quero implementar na minha empresa
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
