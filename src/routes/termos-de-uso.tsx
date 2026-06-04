import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/termos-de-uso")({
  head: () => ({
    meta: [
      { title: "Termos de Uso — Godai Terapias Integrativas" },
      { name: "description", content: "Termos de Uso do site da Godai Terapias Integrativas." },
    ],
  }),
  component: TermosPage,
});

function TermosPage() {
  return (
    <article className="mx-auto max-w-3xl px-6 py-20 md:py-28 lg:px-10">
      <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Legal</span>
      <h1 className="mt-4 text-4xl text-sage-deep md:text-5xl">Termos de Uso</h1>
      <p className="mt-4 text-sm text-muted-foreground">Última atualização: junho de 2026</p>

      <div className="mt-10 space-y-6 text-sm leading-relaxed text-muted-foreground md:text-base">
        <p>
          Bem-vindo ao site da GODAI Terapias Integrativas. Ao acessar e utilizar este site,
          você concorda integralmente com os termos e condições descritos a seguir.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">1. Uso do site</h2>
        <p>
          Este site tem finalidade exclusivamente informativa e comercial relacionada aos
          serviços de Quick Massage Corporativa e bem-estar oferecidos pela Godai. O conteúdo
          pode ser atualizado a qualquer momento, sem aviso prévio.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">2. Propriedade intelectual</h2>
        <p>
          Todos os textos, imagens, marcas, logotipos e demais elementos visuais são de
          propriedade da GODAI Terapias Integrativas. É proibida sua reprodução, distribuição
          ou utilização sem autorização prévia e por escrito.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">3. Solicitações e orçamentos</h2>
        <p>
          As propostas comerciais enviadas após contato pelo site possuem condições, prazos e
          valores específicos, válidos apenas durante o período indicado em cada documento.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">4. Limitação de responsabilidade</h2>
        <p>
          A Godai não se responsabiliza por eventuais indisponibilidades técnicas do site,
          ou por uso indevido das informações disponibilizadas por terceiros.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">5. Privacidade</h2>
        <p>
          O tratamento de dados pessoais segue o disposto na nossa Política de Privacidade,
          em conformidade com a LGPD.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">6. Foro</h2>
        <p>
          Fica eleito o foro da comarca de Indaiatuba/SP para dirimir quaisquer questões
          relacionadas a estes Termos.
        </p>
      </div>
    </article>
  );
}
