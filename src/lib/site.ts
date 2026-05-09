// Configurações comerciais centralizadas (futuramente substituíveis pelo painel admin)
export const SITE = {
  whatsappNumber: "5519999999999", // TODO: substituir pelo número real
  whatsappMessage: "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.",
  instagram: "https://instagram.com/godaiterapias",
  email: "contato@godaiterapias.com.br",
  city: "Indaiatuba/SP",
};

export const whatsappLink = () =>
  `https://wa.me/${SITE.whatsappNumber}?text=${encodeURIComponent(SITE.whatsappMessage)}`;

export const SERVICES = [
  {
    title: "Quick Massage 4h",
    duration: "4 horas",
    capacity: "até 16 atendimentos por terapeuta",
    description: "Sessões de aproximadamente 15 minutos, ideais para ações pontuais.",
  },
  {
    title: "Quick Massage 6h",
    duration: "6 horas",
    capacity: "até 24 atendimentos por terapeuta",
    description: "Formato intermediário, perfeito para SIPATs e dias de bem-estar.",
  },
  {
    title: "Quick Massage 8h",
    duration: "8 horas",
    capacity: "até 32 atendimentos por terapeuta",
    description: "Atendimento completo durante o expediente, alcançando todo o time.",
  },
  {
    title: "SIPAT e Eventos",
    duration: "Sob demanda",
    capacity: "Equipe dimensionada por evento",
    description: "Ações de RH, semanas internas e eventos empresariais.",
  },
  {
    title: "Planos Corporativos Mensais",
    duration: "Recorrente",
    capacity: "Calendário fixo",
    description: "Programas contínuos de qualidade de vida com agenda mensal.",
  },
];

export const PRICING = [
  { time: "4h",  solo: "R$ 790",   soloCap: "até 16 pessoas",  duo: "R$ 1.430", duoCap: "até 32 pessoas" },
  { time: "6h",  solo: "R$ 1.090", soloCap: "até 24 pessoas",  duo: "R$ 2.000", duoCap: "até 48 pessoas" },
  { time: "8h",  solo: "R$ 1.390", soloCap: "até 32 pessoas",  duo: "R$ 2.570", duoCap: "até 64 pessoas" },
];
