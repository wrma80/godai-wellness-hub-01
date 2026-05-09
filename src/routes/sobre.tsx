import { createFileRoute, Link } from "@tanstack/react-router";
import { Mountain, Droplets, Flame, Wind, Sparkles } from "lucide-react";
import zenImg from "@/assets/about-zen.jpg";

export const Route = createFileRoute("/sobre")({
  head: () => ({
    meta: [
      { title: "Sobre — Godai Terapias Integrativas" },
      { name: "description", content: "Conheça a filosofia da Godai: equilíbrio, acolhimento e bem-estar inspirados nos cinco elementos." },
    ],
  }),
  component: SobrePage,
});

const ELEMENTS = [
  { icon: Mountain, label: "Terra", desc: "Estabilidade e enraizamento." },
  { icon: Droplets, label: "Água", desc: "Fluidez e adaptação." },
  { icon: Flame, label: "Fogo", desc: "Energia e transformação." },
  { icon: Wind, label: "Ar", desc: "Leveza e respiração." },
  { icon: Sparkles, label: "Éter", desc: "Conexão e essência." },
];

function SobrePage() {
  return (
    <>
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Sobre a Godai</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">
          Equilíbrio, acolhimento e bem-estar.
        </h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          A GODAI Terapias Integrativas nasceu com o propósito de promover equilíbrio,
          acolhimento e bem-estar através das terapias corporais. Inspirada no conceito
          oriental dos cinco elementos — Terra, Água, Fogo, Ar e Éter — a marca traduz
          harmonia entre corpo, mente e ambiente.
        </p>
      </section>

      <section className="bg-white py-20">
        <div className="mx-auto grid max-w-7xl gap-12 px-6 md:grid-cols-2 md:items-center lg:px-10">
          <div className="overflow-hidden rounded-2xl">
            <img src={zenImg} alt="Composição zen" loading="lazy" className="aspect-square w-full object-cover" />
          </div>
          <div>
            <h2 className="text-3xl text-sage-deep md:text-4xl">Os cinco elementos</h2>
            <p className="mt-4 text-muted-foreground">
              Cada elemento carrega uma força que inspira a forma como cuidamos do
              outro. Juntos, formam o nome e a essência da Godai.
            </p>
            <div className="mt-8 space-y-4">
              {ELEMENTS.map(({ icon: Icon, label, desc }) => (
                <div key={label} className="flex items-start gap-4 rounded-xl border border-sage/10 bg-cream p-4">
                  <div className="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
                    <Icon size={18} />
                  </div>
                  <div>
                    <p className="font-semibold text-sage-deep">{label}</p>
                    <p className="text-sm text-muted-foreground">{desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">Pronto para levar bem-estar à sua empresa?</h2>
          <p className="mx-auto mt-4 max-w-xl text-cream/80">
            Vamos desenhar juntos um programa que combine com a sua equipe e seus objetivos.
          </p>
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
