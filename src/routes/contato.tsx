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

function ContatoPage() {
  const [sent, setSent] = useState(false);

  const onSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const fd = new FormData(e.currentTarget);
    const nome = String(fd.get("nome") ?? "").trim();
    const empresa = String(fd.get("empresa") ?? "").trim();
    const telefone = String(fd.get("telefone") ?? "").trim();
    const email = String(fd.get("email") ?? "").trim();
    const mensagem = String(fd.get("mensagem") ?? "").trim();

    const text = [
      "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.",
      "",
      `Nome: ${nome}`,
      `Empresa: ${empresa}`,
      `Telefone: ${telefone}`,
      `E-mail: ${email}`,
      "",
      `Mensagem: ${mensagem}`,
    ].join("\n");

    const url = `https://wa.me/${SITE.whatsappNumber}?text=${encodeURIComponent(text)}`;
    window.open(url, "_blank");
    setSent(true);
  };

  return (
    <section className="mx-auto max-w-7xl px-6 py-20 md:py-28 lg:px-10">
      <div className="grid gap-12 md:grid-cols-2 md:gap-16">
        <div>
          <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Contato</span>
          <h1 className="mt-4 text-4xl leading-tight text-sage-deep md:text-5xl">
            Vamos conversar sobre o bem-estar da sua equipe.
          </h1>
          <p className="mt-6 text-muted-foreground">
            Preencha o formulário ou fale conosco diretamente. Respondemos rapidamente
            com uma proposta personalizada.
          </p>

          <ul className="mt-10 space-y-4 text-sm">
            <li className="flex items-center gap-3 text-sage-deep">
              <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                <MapPin size={16} />
              </span>
              {SITE.city}
            </li>
            <li>
              <a href={`mailto:${SITE.email}`} className="flex items-center gap-3 text-sage-deep hover:text-sage">
                <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                  <Mail size={16} />
                </span>
                {SITE.email}
              </a>
            </li>
            <li>
              <a href={whatsappLink()} target="_blank" rel="noreferrer" className="flex items-center gap-3 text-sage-deep hover:text-sage">
                <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                  <MessageCircle size={16} />
                </span>
                WhatsApp
              </a>
            </li>
            <li>
              <a href={SITE.instagram} target="_blank" rel="noreferrer" className="flex items-center gap-3 text-sage-deep hover:text-sage">
                <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                  <Instagram size={16} />
                </span>
                Instagram
              </a>
            </li>
          </ul>
        </div>

        <form
          onSubmit={onSubmit}
          className="rounded-2xl border border-sage/10 bg-white p-8 shadow-sm"
        >
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
                <Field name="telefone" label="Telefone" required maxLength={20} />
                <Field name="email" label="E-mail" type="email" required maxLength={150} />
              </div>
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
                Solicitar orçamento <Send size={15} />
              </button>
            </div>
          )}
        </form>
      </div>
    </section>
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
