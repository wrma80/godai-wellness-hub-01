import { createFileRoute, Link } from "@tanstack/react-router";
import { Clock, Users, ArrowRight } from "lucide-react";
import servicesImg from "@/assets/services-corporate.jpg";
import { useServices, usePricing } from "@/lib/cms";

export const Route = createFileRoute("/servicos")({
  head: () => ({
    meta: [
      { title: "Serviços — Quick Massage Corporativa | Godai" },
      { name: "description", content: "Quick Massage Corporativa de 4h, 6h e 8h, SIPATs, eventos e planos mensais para empresas." },
    ],
  }),
  component: ServicosPage,
});

function ServicosPage() {
  return (
    <>
      <section className="mx-auto max-w-7xl px-6 py-20 lg:px-10">
        <div className="grid gap-10 md:grid-cols-2 md:items-end">
          <div>
            <span className="text-xs font-semibold uppercase tracking-[0.25em] text-sage">Serviços</span>
            <h1 className="mt-4 text-4xl leading-tight text-sage-deep md:text-5xl">
              Soluções de Quick Massage para a rotina corporativa.
            </h1>
          </div>
          <p className="text-muted-foreground">
            Atendimento in company com terapeutas qualificados, equipamentos próprios
            e formato sob medida para o seu evento ou programa contínuo.
          </p>
        </div>

        <div className="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {SERVICES.map((s) => (
            <article
              key={s.title}
              className="group relative overflow-hidden rounded-2xl border border-sage/10 bg-white p-7 transition-all hover:-translate-y-1 hover:border-sage/30 hover:shadow-xl"
            >
              <div className="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-sage via-leaf to-sage opacity-0 transition-opacity group-hover:opacity-100" />
              <h3 className="text-xl font-semibold text-sage-deep">{s.title}</h3>
              <div className="mt-4 flex flex-wrap gap-3 text-xs">
                <span className="inline-flex items-center gap-1.5 rounded-full bg-sage/10 px-3 py-1 text-sage-deep">
                  <Clock size={12} /> {s.duration}
                </span>
                <span className="inline-flex items-center gap-1.5 rounded-full bg-cream px-3 py-1 text-sage-deep">
                  <Users size={12} /> {s.capacity}
                </span>
              </div>
              <p className="mt-5 text-sm leading-relaxed text-muted-foreground">{s.description}</p>
            </article>
          ))}
        </div>
      </section>

      <section className="bg-white py-20">
        <div className="mx-auto grid max-w-7xl gap-12 px-6 md:grid-cols-2 md:items-center lg:px-10">
          <div className="overflow-hidden rounded-2xl">
            <img src={servicesImg} alt="Atendimento corporativo" loading="lazy" className="aspect-[4/3] w-full object-cover" />
          </div>
          <div>
            <h2 className="text-3xl text-sage-deep md:text-4xl">Tabela de atendimento</h2>
            <p className="mt-4 text-muted-foreground">
              Valores corporativos com emissão de Nota Fiscal. Atendimento in company.
            </p>
            <div className="mt-8 space-y-3">
              {PRICING.map((row) => (
                <div key={row.time} className="rounded-xl border border-sage/10 p-5">
                  <div className="flex items-center justify-between">
                    <p className="text-2xl font-bold text-sage">{row.time}</p>
                    <span className="text-xs uppercase tracking-wider text-muted-foreground">por jornada</span>
                  </div>
                  <div className="mt-4 grid grid-cols-2 gap-4 text-sm">
                    <div>
                      <p className="text-xs text-muted-foreground">1 terapeuta</p>
                      <p className="font-semibold text-sage-deep">{row.solo}</p>
                      <p className="text-xs text-muted-foreground">{row.soloCap}</p>
                    </div>
                    <div>
                      <p className="text-xs text-muted-foreground">2 terapeutas</p>
                      <p className="font-semibold text-sage-deep">{row.duo}</p>
                      <p className="text-xs text-muted-foreground">{row.duoCap}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
            <Link
              to="/contato"
              className="mt-8 inline-flex items-center gap-2 rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream hover:bg-sage-deep"
            >
              Solicitar orçamento <ArrowRight size={16} />
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
