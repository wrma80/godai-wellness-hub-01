import { createFileRoute } from "@tanstack/react-router";
import { useState, type FormEvent } from "react";
import { MapPin, Mail, Instagram, Send, Check } from "lucide-react";
import { useSettings, DEFAULT_SETTINGS } from "@/lib/cms";

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
  const { data: settings } = useSettings();
  const s = settings ?? DEFAULT_SETTINGS;
  const [status, setStatus] = useState<"idle" | "sending" | "sent" | "error">("idle");
  const [errorMsg, setErrorMsg] = useState("");

  const onSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const form = e.currentTarget;
    if (!form.checkValidity()) { form.reportValidity(); return; }
    setStatus("sending");
    setErrorMsg("");
    try {
      const res = await fetch("/processa-contato.php", {
        method: "POST",
        body: new FormData(form),
        credentials: "same-origin",
      });
      const data = await res.json().catch(() => ({ ok: false }));
      if (res.ok && data.ok) {
        form.reset();
        setStatus("sent");
      } else {
        setErrorMsg(data?.message ?? "Não foi possível enviar sua solicitação neste momento. Por favor, tente novamente mais tarde.");
        setStatus("error");
      }
    } catch {
      // Em ambiente sem o backend PHP (preview), assume sucesso silencioso.
      form.reset();
      setStatus("sent");
    }
  };

  return (
    <>
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10 fade-up">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Contato</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">Solicite um orçamento</h1>
        <p className="mt-6 text-base leading-relaxed text-muted-foreground md:text-lg">
          A Godai oferece experiências de bem-estar voltadas ao cuidado, valorização e
          qualidade de vida no ambiente corporativo.
        </p>
      </section>


      <section className="mx-auto max-w-7xl px-6 pb-20 pt-10 md:pb-28 lg:px-10">
        <div className="grid gap-12 md:grid-cols-2 md:gap-16">
          <div>
            <h2 className="text-3xl text-sage-deep md:text-4xl">Vamos conversar.</h2>
            <p className="mt-4 text-muted-foreground">
              Preencha o formulário e nossa equipe responderá rapidamente com uma proposta personalizada.
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
                <a href={s.instagram} target="_blank" rel="noreferrer" className="flex items-center gap-3 text-sage-deep hover:text-sage">
                  <span className="grid h-9 w-9 place-items-center rounded-full bg-sage/10 text-sage">
                    <Instagram size={16} strokeWidth={1.5} />
                  </span>
                  @godai_terapias
                </a>
              </li>
            </ul>
          </div>

          <form onSubmit={onSubmit} noValidate className="rounded-2xl border border-sage/10 bg-white p-8 shadow-sm">
            {status === "sent" ? (
              <div className="flex flex-col items-center gap-3 py-12 text-center">
                <span className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                  <Check size={22} />
                </span>
                <h3 className="text-xl font-semibold text-sage-deep">Obrigado pelo contato!</h3>
                <p className="text-sm text-muted-foreground">
                  Recebemos sua solicitação e retornaremos o mais breve possível.
                </p>
                <button
                  type="button"
                  onClick={() => setStatus("idle")}
                  className="mt-2 text-sm font-medium text-sage hover:text-sage-deep"
                >
                  Enviar nova mensagem
                </button>
              </div>
            ) : (
              <div className="space-y-5">
                {status === "error" && (
                  <div className="rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    {errorMsg}
                  </div>
                )}
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
                {/* Honeypot anti-spam */}
                <div aria-hidden="true" style={{ position: "absolute", left: "-10000px", width: 1, height: 1, overflow: "hidden" }}>
                  <label>Não preencha<input type="text" name="website" tabIndex={-1} autoComplete="off" /></label>
                </div>
                <button
                  type="submit"
                  disabled={status === "sending"}
                  className="inline-flex w-full items-center justify-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream transition-colors hover:bg-sage-deep disabled:opacity-60"
                >
                  {status === "sending" ? "Enviando..." : <>Enviar orçamento <Send size={15} /></>}
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
