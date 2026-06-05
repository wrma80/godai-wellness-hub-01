import { createFileRoute, Link } from "@tanstack/react-router";
import { Award, Target, Eye, Heart, MapPin, Globe2, Users, Sparkles, Check } from "lucide-react";
import zenImg from "@/assets/about-zen.jpg";

export const Route = createFileRoute("/sobre")({
  head: () => ({
    meta: [
      { title: "Sobre — Godai Terapias Integrativas" },
      { name: "description", content: "Conheça a história, a fundadora e a trajetória da Godai Terapias Integrativas — bem-estar corporativo com experiência nacional e internacional." },
    ],
  }),
  component: SobrePage,
});

const TIMELINE: Array<{ year: string; title?: string; items: string[] }> = [
  { year: "2001", items: ["Início da formação em Naturopatia, Shiatsu, Acupuntura e Bambuterapia."] },
  { year: "2002", items: ["Primeiros atendimentos terapêuticos em domicílio."] },
  { year: "2005", items: ["Início da atuação em Quick Massage Corporativa.", "Empresas atendidas: Procter & Gamble, Braskem, Locaweb."] },
  { year: "2013", items: ["Mudança para o Japão.", "Continuidade dos atendimentos terapêuticos."] },
  { year: "2016", items: ["Especialização em Chiang Mai (Tailândia).", "Formações em Thai Table Massage, Reflexologia e Foot Massage."] },
  { year: "2016–2024", items: ["Atendimentos e vivência internacional.", "Países: Japão, Tailândia, México e Estados Unidos."] },
  { year: "Atualmente", items: ["Fundação da Godai Terapias Integrativas no Brasil."] },
];

const VALORES = [
  "Cuidado com as pessoas",
  "Cliente em primeiro lugar",
  "Qualidade e excelência",
  "Ética e transparência",
  "Humanização",
];

function SobrePage() {
  return (
    <>
      {/* HERO */}
      <section className="mx-auto max-w-4xl px-6 py-20 text-center md:py-28 lg:px-10">
        <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Sobre a Godai</span>
        <h1 className="mt-6 text-4xl leading-tight text-sage-deep md:text-5xl">
          Uma história construída pelo cuidado com as pessoas.
        </h1>
        <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground md:text-lg">
          <p>
            Há mais de duas décadas, nossa trajetória é guiada por um propósito simples:
            promover experiências de bem-estar que contribuam para uma rotina mais
            equilibrada, saudável e humana.
          </p>
          <p>
            Hoje, a Godai Terapias Integrativas reúne experiência nacional e internacional
            para levar às empresas soluções de bem-estar voltadas à valorização das
            pessoas e à qualidade de vida no ambiente corporativo.
          </p>
        </div>
      </section>

      {/* NOSSA ORIGEM */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto grid max-w-7xl gap-14 px-6 md:grid-cols-2 md:items-center lg:px-10">
          <div className="overflow-hidden rounded-2xl">
            <img src={zenImg} alt="Equilíbrio e elementos naturais" loading="lazy" className="aspect-[4/5] w-full object-cover" />
          </div>
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Nossa origem</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Como nasceu a Godai</h2>
            <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground">
              <p>
                A Godai Terapias Integrativas nasceu da união entre experiência, propósito
                e paixão pelo cuidado humano.
              </p>
              <p>
                Após mais de 20 anos de atuação em terapias integrativas, atendimentos
                corporativos e experiências de bem-estar em diferentes países, surgiu o
                desejo de transformar essa trajetória em um projeto capaz de levar
                equilíbrio, acolhimento e qualidade de vida para empresas e colaboradores.
              </p>
              <p>
                Inspirada pelo conceito japonês <em>"Godai"</em>, que representa os cinco
                elementos da natureza, a empresa foi criada para promover experiências
                que conectam corpo, mente e bem-estar.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* TIMELINE DA FUNDADORA */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-5xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Trajetória</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Timeline da Fundadora</h2>
          </div>
          <ol className="relative mt-14 border-l border-sage/20 pl-8 md:ml-6">
            {TIMELINE.map((t) => (
              <li key={t.year} className="mb-10 last:mb-0">
                <span className="absolute -left-[9px] grid h-4 w-4 place-items-center rounded-full border-2 border-sage bg-cream" />
                <p className="text-sm font-semibold uppercase tracking-[0.2em] text-sage">{t.year}</p>
                <ul className="mt-3 space-y-2 text-sm leading-relaxed text-muted-foreground md:text-base">
                  {t.items.map((it) => (
                    <li key={it}>{it}</li>
                  ))}
                </ul>
              </li>
            ))}
          </ol>
        </div>
      </section>

      {/* EXPANSÃO E ATUAÇÃO CONJUNTA */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-4xl px-6 lg:px-10">
          <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Expansão e atuação conjunta</span>
          <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Duas trajetórias, um mesmo propósito</h2>
          <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground">
            <p>
              Com a expansão da Godai, Wellington Aires passou a integrar oficialmente a
              empresa como sócio proprietário e terapeuta.
            </p>
            <p>
              Com formação em Quick Massage pelo Senac e experiência corporativa em
              ambientes industriais e organizacionais, contribui para o desenvolvimento
              das experiências de bem-estar voltadas às empresas.
            </p>
            <p>
              A união de diferentes experiências fortalece a atuação da Godai e amplia a
              capacidade de oferecer atendimentos humanizados, profissionais e alinhados
              às necessidades do ambiente corporativo.
            </p>
          </div>
        </div>
      </section>

      {/* EXPERIÊNCIA INTERNACIONAL */}
      <section className="bg-sage py-20 text-cream md:py-28">
        <div className="mx-auto max-w-4xl px-6 text-center lg:px-10">
          <div className="mx-auto grid h-14 w-14 place-items-center rounded-full bg-cream/10">
            <Globe2 size={24} strokeWidth={1.5} />
          </div>
          <span className="mt-6 inline-block text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">Experiência internacional</span>
          <h2 className="mt-4 text-3xl md:text-4xl">Uma visão global sobre bem-estar</h2>
          <div className="mt-6 space-y-4 text-base leading-relaxed text-cream/85">
            <p>
              Nossa trajetória inclui atendimentos e experiências profissionais em
              diferentes países, permitindo compreender como o cuidado com as pessoas é
              valorizado em diferentes culturas.
            </p>
            <p>
              Essa vivência internacional influencia diretamente a forma como
              desenvolvemos experiências de bem-estar corporativo: com atenção aos
              detalhes, acolhimento e foco na experiência do colaborador.
            </p>
          </div>
        </div>
      </section>

      {/* MISSÃO VISÃO VALORES */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-7xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Identidade</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Missão, Visão e Valores</h2>
          </div>
          <div className="mt-12 grid gap-6 md:grid-cols-3">
            <div className="rounded-2xl border border-sage/10 bg-cream/40 p-8 transition-all hover:border-sage/30 hover:bg-cream">
              <div className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                <Target size={22} strokeWidth={1.5} />
              </div>
              <h3 className="mt-5 text-xl text-sage-deep">Missão</h3>
              <p className="mt-3 text-sm leading-relaxed text-muted-foreground">
                Promover experiências de bem-estar corporativo voltadas à qualidade de
                vida, equilíbrio e valorização das pessoas.
              </p>
            </div>
            <div className="rounded-2xl border border-sage/10 bg-cream/40 p-8 transition-all hover:border-sage/30 hover:bg-cream">
              <div className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                <Eye size={22} strokeWidth={1.5} />
              </div>
              <h3 className="mt-5 text-xl text-sage-deep">Visão</h3>
              <p className="mt-3 text-sm leading-relaxed text-muted-foreground">
                Ser referência em wellness corporativo e experiências integrativas
                humanizadas.
              </p>
            </div>
            <div className="rounded-2xl border border-sage/10 bg-cream/40 p-8 transition-all hover:border-sage/30 hover:bg-cream">
              <div className="grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
                <Heart size={22} strokeWidth={1.5} />
              </div>
              <h3 className="mt-5 text-xl text-sage-deep">Valores</h3>
              <ul className="mt-4 space-y-2 text-sm text-muted-foreground">
                {VALORES.map((v) => (
                  <li key={v} className="flex items-start gap-2">
                    <Check size={14} className="mt-1 shrink-0 text-sage" strokeWidth={1.75} />
                    <span>{v}</span>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* FUNDADORES (CERTIFICAÇÕES) */}
      <section className="bg-cream py-20 md:py-28">
        <div className="mx-auto max-w-5xl px-6 lg:px-10">
          <div className="text-center">
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Certificações e formações</span>
            <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Fundadores</h2>
          </div>
          <div className="mt-12 grid gap-6 md:grid-cols-2">
            <div className="rounded-2xl border border-sage/10 bg-white p-8">
              <div className="flex items-center gap-3">
                <Award size={20} className="text-sage" strokeWidth={1.5} />
                <h3 className="text-xl text-sage-deep">Erica Aires</h3>
              </div>
              <ul className="mt-5 space-y-2 text-sm text-muted-foreground">
                {["Naturopatia","Shiatsu","Acupuntura","Bambuterapia","Thai Table Massage","Reflexologia","Foot Massage"].map(c => (
                  <li key={c} className="flex items-center gap-2"><span className="h-1 w-1 rounded-full bg-sage"/>{c}</li>
                ))}
              </ul>
            </div>
            <div className="rounded-2xl border border-sage/10 bg-white p-8">
              <div className="flex items-center gap-3">
                <Award size={20} className="text-sage" strokeWidth={1.5} />
                <h3 className="text-xl text-sage-deep">Wellington Aires</h3>
              </div>
              <ul className="mt-5 space-y-2 text-sm text-muted-foreground">
                <li className="flex items-center gap-2"><span className="h-1 w-1 rounded-full bg-sage"/>Formação em Quick Massage — Senac</li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      {/* REDE DE PROFISSIONAIS PARCEIROS */}
      <section className="bg-white py-20 md:py-28">
        <div className="mx-auto max-w-4xl px-6 text-center lg:px-10">
          <div className="mx-auto grid h-14 w-14 place-items-center rounded-full bg-sage/10 text-sage">
            <Users size={24} strokeWidth={1.5} />
          </div>
          <span className="mt-6 inline-block text-xs font-semibold uppercase tracking-[0.25em] text-sage">Parcerias</span>
          <h2 className="mt-4 text-3xl text-sage-deep md:text-4xl">Rede de Profissionais Parceiros</h2>
          <div className="mt-6 space-y-4 text-base leading-relaxed text-muted-foreground">
            <p>
              A Godai está preparada para ampliar sua capacidade de atendimento através
              de uma rede de terapeutas parceiros cuidadosamente selecionados.
            </p>
            <p>
              Todos os profissionais passam por critérios de avaliação relacionados à
              formação, experiência, postura profissional, qualidade do atendimento e
              alinhamento aos valores da empresa.
            </p>
            <p>
              Nosso compromisso é garantir uma experiência de bem-estar consistente,
              humanizada e de excelência, independentemente do tamanho da ação ou do
              número de profissionais envolvidos.
            </p>
          </div>
        </div>
      </section>

      {/* REGIÃO DE ATENDIMENTO */}
      <section className="bg-cream py-16">
        <div className="mx-auto max-w-4xl px-6 text-center lg:px-10">
          <div className="mx-auto grid h-12 w-12 place-items-center rounded-full bg-sage/10 text-sage">
            <MapPin size={22} strokeWidth={1.5} />
          </div>
          <h2 className="mt-5 text-2xl text-sage-deep md:text-3xl">Região de atendimento</h2>
          <p className="mt-3 text-muted-foreground">
            Atendemos empresas em <strong className="text-sage-deep">Indaiatuba/SP</strong>.<br />
            Demais regiões mediante consulta.
          </p>
        </div>
      </section>

      {/* CTA FINAL */}
      <section className="bg-sage py-20 text-cream">
        <div className="mx-auto max-w-3xl px-6 text-center lg:px-10">
          <span className="inline-block text-xs font-semibold uppercase tracking-[0.25em] text-cream/70">
            <Sparkles size={14} className="mr-1 inline" /> Vamos juntos
          </span>
          <h2 className="mt-4 text-3xl md:text-4xl">Leve experiências de bem-estar para sua empresa</h2>
          <p className="mt-4 text-cream/85">
            Conheça nossas soluções de Quick Massage Corporativa e descubra como promover
            mais qualidade de vida, equilíbrio e valorização para sua equipe.
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
