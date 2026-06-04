import { createFileRoute } from "@tanstack/react-router";

export const Route = createFileRoute("/politica-de-privacidade")({
  head: () => ({
    meta: [
      { title: "Política de Privacidade — Godai Terapias Integrativas" },
      { name: "description", content: "Política de Privacidade da Godai Terapias Integrativas — como coletamos, usamos e protegemos os seus dados." },
    ],
  }),
  component: PoliticaPage,
});

function PoliticaPage() {
  return (
    <article className="mx-auto max-w-3xl px-6 py-20 md:py-28 lg:px-10">
      <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Legal</span>
      <h1 className="mt-4 text-4xl text-sage-deep md:text-5xl">Política de Privacidade</h1>
      <p className="mt-4 text-sm text-muted-foreground">Última atualização: junho de 2026</p>

      <div className="prose prose-sage mt-10 space-y-6 text-sm leading-relaxed text-muted-foreground md:text-base">
        <p>
          A GODAI Terapias Integrativas valoriza a privacidade dos visitantes e clientes deste
          site. Esta Política descreve como coletamos, utilizamos e protegemos as informações
          pessoais fornecidas, em conformidade com a Lei Geral de Proteção de Dados (LGPD —
          Lei nº 13.709/2018).
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">1. Dados coletados</h2>
        <p>
          Coletamos dados informados voluntariamente em nossos formulários (nome, e-mail,
          telefone/WhatsApp, empresa, cidade e mensagem) para responder solicitações de
          orçamento e contato.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">2. Finalidade de uso</h2>
        <p>
          As informações são utilizadas exclusivamente para envio de propostas, agendamentos,
          comunicação institucional e melhoria dos nossos serviços de bem-estar corporativo.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">3. Compartilhamento</h2>
        <p>
          Não vendemos nem compartilhamos dados pessoais com terceiros, exceto quando exigido
          por obrigação legal ou para a operação técnica essencial do atendimento.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">4. Segurança</h2>
        <p>
          Adotamos medidas técnicas e administrativas razoáveis para proteger as informações
          contra acessos não autorizados, perda ou divulgação indevida.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">5. Direitos do titular</h2>
        <p>
          O titular dos dados pode solicitar a qualquer momento o acesso, correção, exclusão ou
          portabilidade de suas informações, entrando em contato pelos canais oficiais da Godai.
        </p>

        <h2 className="text-xl font-semibold text-sage-deep">6. Contato</h2>
        <p>
          Em caso de dúvidas sobre esta Política, fale conosco pelo e-mail
          contato@godaiterapias.com.br.
        </p>
      </div>
    </article>
  );
}
