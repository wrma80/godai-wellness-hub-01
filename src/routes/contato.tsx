import { createFileRoute } from "@tanstack/react-router";
import { useState, type FormEvent } from "react";
import { MapPin, Mail, MessageCircle, Instagram, Send, Check } from "lucide-react";
import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export const Route = createFileRoute("/contato")({
  head: () => ({
    meta: [
      { title: "Contato — Solicite um orçamento | Godai" },
      { name: "description", content: "Fale com a Godai Terapias Integrativas e leve a Quick Massage Corporativa para a sua empresa em Indaiatuba/SP e região." },
    ],
  }),
  component: ContatoPage,
});

const DIFS = [
  "Atendimento personalizado",
  "Estrutura inclusa",
  "Atendimento corporativo",
  "Flexibilidade de horários",
];

function ContatoPage() {
  const { data: settings } = useSettings();
  const s = settings ?? DEFAULT_SETTINGS;
  const [sent, setSent] = useState(false);

  const onSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    const text = [
      "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.",
      "",
      `Nome: ${String(fd.get("nome") ?? "").trim()}`,
      `Empresa: ${String(fd.get("empresa") ?? "").trim()}`,
      `WhatsApp: ${String(fd.get("whatsapp") ?? "").trim()}`,
      `E-mail: ${String(fd.get("email") ?? "").trim()}`,
      `Cidade: ${String(fd.get("cidade") ?? "").trim()}`,
      `Tipo de atendimento: ${String(fd.get("tipo") ?? "").trim()}`,
      `Quantidade de colaboradores: ${String(fd.get("colaboradores") ?? "").trim()}`,
      "",
      `Mensagem: ${String(fd.get("mensagem") ?? "").trim()}`,
    ].join("\n");

    const url = `https://wa.me/${s.whatsappNumber}?text=${encodeURIComponent(text)}`;
    window.open(url, "_blank");
    setSent(true);
  };

  return (
    <>
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Contato</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">Solicite um orçamento</h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          A Godai oferece experiências de bem-estar voltadas ao cuidado, valorização e
          qualidade de vida no ambiente corporativo.
        </p>
      </section>

      <section className="bg-white py-10">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            {DIFS.map((d) => (
              <div key={d} className="flex items-center gap-3 rounded-xl border border-sage/10 bg-cream/40 p-4">
                <span className="grid h-8 w-8 place-items-center rounded-full bg-sage/10 text-sage">
                  <Check size={14} strokeWidth={1.75} />
                </span>
                <p className="text-sm text-sage-deep">{d}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="mx-auto max-w-7xl px-6 pb-20 pt-10 md:pb-28 lg:px-10">
        <div className="grid gap-12 md:grid-cols-2 md:gap-16">
          <div>
            <h2 className="text-3xl text-sage-deep md:text-4xl">Vamos conversar.</h2>
            <p className="mt-4 text-muted-foreground">
              Preencha o formulário ou fale conosco diretamente. Respondemos rapidamente
              com uma proposta personalizada.
            </p>

            <ul className="mt-10 space-y-4 text-sm">
              <li className="flex items-center gap-3 text-sage-deep">
                <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                  <MapPin size={16} strokeWidth={1.5} />
                </span>
                {s.city}
              </li>
              <li>
                <a href={`mailto:${s.email}`} className="flex items-center gap-3 text-sage-deep hover:text-sage">
                  <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                    <Mail size={16} strokeWidth={1.5} />
                  </span>
                  {s.email}
                </a>
              </li>
              <li>
                <a href={buildWhatsappLink(s)} target="_blank" rel="noreferrer" className="flex items-center gap-3 text-sage-deep hover:text-sage">
                  <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                    <MessageCircle size={16} strokeWidth={1.5} />
                  </span>
                  WhatsApp
                </a>
              </li>
              <li>
                <a href={s.instagram} target="_blank" rel="noreferrer" className="flex items-center gap-3 text-sage-deep hover:text-sage">
                  <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                    <Instagram size={16} strokeWidth={1.5} />
                  </span>
                  Instagram
                </a>
              </li>
            </ul>

            <div className="mt-10 rounded-2xl border border-sage/10 bg-cream/40 p-6">
              <p className="text-xs font-semibold uppercase tracking-[0.2em] text-sage">Área de atendimento</p>
              <p className="mt-2 text-sm text-sage-deep">Indaiatuba/SP — demais regiões mediante consulta.</p>
            </div>
          </div>

          <form onSubmit={onSubmit} className="rounded-2xl border border-sage/10 bg-white p-8 shadow-sm">
            {sent ? (
              <div className="flex flex-col items-center gap-3 py-12 text-center">
                <span className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                  <Check size={22} />
                </span>
                <h3 className="text-xl font-semibold text-sage-deep">Mensagem encaminhada!</h3>
                <p className="text-sm text-muted-foreground">
                  Continue a conversa com nossa equipe pelo WhatsApp que abrimos para você.
                </p>
                <button
                  type="button"
                  onClick={() => setSent(false)}
                  className="mt-2 text-sm font-medium text-sage hover:text-sage-deep"
                >
                  Enviar nova mensagem
                </button>
              </div>
            ) : (
              <div className="space-y-5">
                <Field name="nome" label="Nome" required maxLength={100} />
                <Field name="empresa" label="Empresa" required maxLength={120} />
                <div className="grid gap-5 sm:grid-cols-2">
                  <Field name="whatsapp" label="WhatsApp" type="tel" required maxLength={20} />
                  <Field name="email" label="E-mail" type="email" required maxLength={150} />
                </div>
                <div className="grid gap-5 sm:grid-cols-2">
                  <Field name="cidade" label="Cidade" required maxLength={80} />
                  <div>
                    <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">Tipo de atendimento</label>
                    <select
                      name="tipo"
                      required
                      defaultValue=""
                      className="mt-2 w-full rounded-lg border border-sage/15 bg-cream/40 px-4 py-3 text-sm outline-none transition-colors focus:border-sage focus:bg-white"
                    >
                      <option value="" disabled>Selecione</option>
                      <option>Avulso / Ação Pontual</option>
                      <option>Pacote Corporativo</option>
                      <option>Programa Corporativo</option>
                      <option>SIPAT / Evento</option>
                    </select>
                  </div>
                </div>
                <Field name="colaboradores" label="Quantidade de colaboradores" type="number" required maxLength={6} />
                <div>
                  <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">Mensagem</label>
                  <textarea
                    name="mensagem"
                    required
                    maxLength={1000}
                    rows={4}
                    className="mt-2 w-full rounded-lg border border-sage/15 bg-cream/40 px-4 py-3 text-sm outline-none transition-colors focus:border-sage focus:bg-white"
                  />
                </div>
                <button
                  type="submit"
                  className="inline-flex w-full items-center justify-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream transition-colors hover:bg-sage-deep"
                >
                  Enviar orçamento <Send size={15} />
                </button>
              </div>
            )}
          </form>
        </div>
      </section>
    </>
  );
}

function Field({ name, label, type = "text", required, maxLength }: { name: string; label: string; type?: string; required?: boolean; maxLength?: number }) {
  return (
    <div>
      <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">{label}</label>
      <input
        name={name}
        type={type}
        required={required}
        maxLength={maxLength}
        className="mt-2 w-full rounded-lg border border-sage/15 bg-cream/40 px-4 py-3 text-sm outline-none transition-colors focus:border-sage focus:bg-white"
      />
    </div>
  );
}
