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
  whatsappNumber: "5519999999999",
  whatsappMessage: "Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.",
  email: "contato@godaiterapias.com.br",
  instagram: "https://instagram.com/godaiterapias",
  city: "Indaiatuba/SP",
};

export type Service = {
  id: string;
  title: string;
  duration: string;
  capacity: string;
  description: string;
  display_order: number;
};

export type PricingRow = {
  id: string;
  time_label: string;
  solo_price: string;
  solo_capacity: string;
  duo_price: string;
  duo_capacity: string;
  display_order: number;
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

export function useServices() {
  return useQuery({
    queryKey: ["services"],
    queryFn: async (): Promise<Service[]> => {
      const { data, error } = await supabase
        .from("services")
        .select("*")
        .order("display_order", { ascending: true });
      if (error) throw error;
      return data ?? [];
    },
    staleTime: 60_000,
  });
}

export function usePricing() {
  return useQuery({
    queryKey: ["pricing"],
    queryFn: async (): Promise<PricingRow[]> => {
      const { data, error } = await supabase
        .from("pricing")
        .select("*")
        .order("display_order", { ascending: true });
      if (error) throw error;
      return data ?? [];
    },
    staleTime: 60_000,
  });
}

export function buildWhatsappLink(s: SettingsMap, customMessage?: string) {
  const number = s.whatsappNumber.replace(/\D/g, "") || DEFAULT_SETTINGS.whatsappNumber;
  const text = customMessage ?? s.whatsappMessage ?? DEFAULT_SETTINGS.whatsappMessage;
  return `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
}
