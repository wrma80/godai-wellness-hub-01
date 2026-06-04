import { createFileRoute } from "@tanstack/react-router";
import { useState } from "react";
import { Plus, Minus, MessageCircle } from "lucide-react";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/faq")({
  head: () => ({
    meta: [
      { title: "FAQ — Perguntas frequentes | Godai" },
      { name: "description", content: "Tire suas dúvidas sobre a Quick Massage Corporativa da Godai: estrutura, atendimento, regiões, nota fiscal e mais." },
    ],
  }),
  component: FaqPage,
});

const FAQ = [
  {
    q: "Quantos colaboradores são atendidos por hora?",
    a: "Em média, um terapeuta atende de 4 a 6 colaboradores por hora considerando sessões de 10 a 15 minutos. O número exato é definido conforme o formato do evento e a quantidade de profissionais alocados.",
  },
  {
    q: "Precisa de sala?",
    a: "Não é obrigatório. Atendemos em qualquer ambiente reservado, como sala de reunião, copa, recepção ou área de descompressão. Apenas indicamos um espaço com boa privacidade e ventilação.",
  },
  {
    q: "Vocês levam cadeira?",
    a: "Sim. A cadeira ergonômica de Quick Massage está inclusa em todos os atendimentos, sem custo adicional.",
  },
  {
    q: "A Quick Massage utiliza óleo?",
    a: "Não. A técnica é realizada com o colaborador vestido, sem uso de óleos ou cremes — totalmente prática para o ambiente corporativo.",
  },
  {
    q: "Atendem finais de semana?",
    a: "Sim, atendemos finais de semana mediante agendamento prévio, especialmente para eventos, SIPATs e ações pontuais.",
  },
  {
    q: "Emitem nota fiscal?",
    a: "Sim. Emitimos Nota Fiscal de Serviço para todos os atendimentos corporativos.",
  },
  {
    q: "Atendem outras cidades?",
    a: "Nosso atendimento principal é em Indaiatuba/SP. Demais regiões são atendidas mediante consulta de disponibilidade e custos de deslocamento.",
  },
];

function FaqPage() {
  const { data: settings } = useSettings();
  const s = settings ?? DEFAULT_SETTINGS;
  const [open, setOpen] = useState<number | null>(0);

  return (
    <>
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">FAQ</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">Perguntas frequentes</h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          Reunimos as dúvidas mais comuns sobre a Quick Massage Corporativa.
        </p>
      </section>

      <section className="bg-white pb-20">
        <div className="mx-auto max-w-3xl px-6 lg:px-10">
          <div className="space-y-3">
            {FAQ.map((item, i) => {
              const isOpen = open === i;
              return (
                <div key={item.q} className="overflow-hidden rounded-2xl border border-sage/10 bg-cream/40 transition-all">
                  <button
                    type="button"
                    aria-expanded={isOpen}
                    onClick={() => setOpen(isOpen ? null : i)}
                    className="flex w-full items-center justify-between gap-4 px-6 py-5 text-left transition-colors hover:bg-cream"
                  >
                    <span className="text-base font-medium text-sage-deep md:text-lg">{item.q}</span>
                    <span className="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-sage/10 text-sage">
                      {isOpen ? <Minus size={16} strokeWidth={1.75} /> : <Plus size={16} strokeWidth={1.75} />}
                    </span>
                  </button>
                  {isOpen && (
                    <div className="px-6 pb-6 text-sm leading-relaxed text-muted-foreground md:text-base">
                      {item.a}
                    </div>
                  )}
                </div>
              );
            })}
          </div>
        </div>
      </section>

      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <h2 className="text-3xl md:text-4xl">Ainda ficou com dúvidas?</h2>
          <a
            href={buildWhatsappLink(s)}
            target="_blank"
            rel="noreferrer"
            className="mt-8 inline-flex items-center gap-2 rounded-full bg-cream px-6 py-3 text-sm font-medium text-sage-deep transition-transform hover:scale-[1.02]"
          >
            <MessageCircle size={16} /> Falar no WhatsApp
          </a>
        </div>
      </section>
    </>
  );
}
