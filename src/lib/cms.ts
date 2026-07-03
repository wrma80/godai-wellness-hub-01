import { useQuery } from "@tanstack/react-query";
import { supabase } from "@/integrations/supabase/client";

export type SettingsMap = {
  whatsappNumber: string;
  whatsappMessage: string;
  email: string;
  instagram: string;
  city: string;
};

export const DEFAULT_SETTINGS: SettingsMap = {
  whatsappNumber: "5519997016552",
  whatsappMessage: "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.",
  email: "contato@godaiterapias.com.br",
  instagram: "https://instagram.com/godai_terapias",
  city: "Indaiatuba/SP",
};

export function useSettings() {
  return useQuery({
    queryKey: ["site_settings"],
    queryFn: async (): Promise<SettingsMap> => {
      const { data, error } = await supabase.from("site_settings").select("key,value");
      if (error) throw error;
      const map = { ...DEFAULT_SETTINGS };
      (data ?? []).forEach((row) => {
        if (row.key in map) (map as Record<string, string>)[row.key] = row.value;
      });
      return map;
    },
    staleTime: 60_000,
  });
}

export function buildWhatsappLink(s: SettingsMap, customMessage?: string) {
  const number = s.whatsappNumber.replace(/\D/g, "") || DEFAULT_SETTINGS.whatsappNumber;
  const text = customMessage ?? s.whatsappMessage ?? DEFAULT_SETTINGS.whatsappMessage;
  return `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
}
