import { createFileRoute, useNavigate } from "@tanstack/react-router";
import { useEffect, useMemo, useState } from "react";
import { useQueryClient } from "@tanstack/react-query";
import { LogOut, Plus, Save, Trash2, Loader2 } from "lucide-react";
import { supabase } from "@/integrations/supabase/client";
import { useAuth } from "@/hooks/use-auth";
import {
  useSettings,
  useServices,
  usePricing,
  type Service,
  type PricingRow,
  type SettingsMap,
} from "@/lib/cms";

export const Route = createFileRoute("/admin/")({
  component: AdminDashboard,
});

type Tab = "servicos" | "precos" | "contatos";

function AdminDashboard() {
  const navigate = useNavigate();
  const { session, isAdmin, loading } = useAuth();
  const [tab, setTab] = useState<Tab>("servicos");

  useEffect(() => {
    if (!loading && !session) navigate({ to: "/admin/login" });
  }, [loading, session, navigate]);

  if (loading || !session) {
    return <div className="grid place-items-center py-20"><Loader2 className="animate-spin text-sage" /></div>;
  }

  if (!isAdmin) {
    return (
      <div className="mx-auto max-w-md rounded-2xl border border-sage/10 bg-white p-8 text-center">
        <h2 className="text-lg font-semibold text-sage-deep">Acesso restrito</h2>
        <p className="mt-2 text-sm text-muted-foreground">
          Sua conta não tem permissão de administrador.
        </p>
        <button
          onClick={() => supabase.auth.signOut().then(() => navigate({ to: "/admin/login" }))}
          className="mt-6 rounded-full bg-sage px-5 py-2 text-sm text-cream hover:bg-sage-deep"
        >
          Sair
        </button>
      </div>
    );
  }

  return (
    <div>
      <div className="flex flex-wrap items-center justify-between gap-3">
        <div className="flex flex-wrap gap-1 rounded-full border border-sage/15 bg-white p-1">
          <TabBtn active={tab === "servicos"} onClick={() => setTab("servicos")}>Serviços</TabBtn>
          <TabBtn active={tab === "precos"} onClick={() => setTab("precos")}>Preços</TabBtn>
          <TabBtn active={tab === "contatos"} onClick={() => setTab("contatos")}>Contatos</TabBtn>
        </div>
        <button
          onClick={() => supabase.auth.signOut().then(() => navigate({ to: "/admin/login" }))}
          className="inline-flex items-center gap-2 text-xs text-sage-deep hover:text-sage"
        >
          <LogOut size={14} /> Sair
        </button>
      </div>

      <div className="mt-6">
        {tab === "servicos" && <ServicesEditor />}
        {tab === "precos" && <PricingEditor />}
        {tab === "contatos" && <SettingsEditor />}
      </div>
    </div>
  );
}

function TabBtn({ active, children, onClick }: { active: boolean; children: React.ReactNode; onClick: () => void }) {
  return (
    <button
      onClick={onClick}
      className={`rounded-full px-4 py-2 text-xs font-medium transition-colors ${
        active ? "bg-sage text-cream" : "text-sage-deep hover:bg-sage/5"
      }`}
    >
      {children}
    </button>
  );
}

function Card({ children }: { children: React.ReactNode }) {
  return <div className="rounded-2xl border border-sage/10 bg-white p-6 shadow-sm">{children}</div>;
}

function Field({ label, value, onChange, type = "text" }: { label: string; value: string; onChange: (v: string) => void; type?: string }) {
  return (
    <div>
      <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">{label}</label>
      <input
        type={type}
        value={value}
        onChange={(e) => onChange(e.target.value)}
        className="mt-1.5 w-full rounded-lg border border-sage/15 bg-cream/40 px-3 py-2 text-sm outline-none focus:border-sage focus:bg-white"
      />
    </div>
  );
}

function TextArea({ label, value, onChange }: { label: string; value: string; onChange: (v: string) => void }) {
  return (
    <div>
      <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">{label}</label>
      <textarea
        value={value}
        onChange={(e) => onChange(e.target.value)}
        rows={3}
        className="mt-1.5 w-full rounded-lg border border-sage/15 bg-cream/40 px-3 py-2 text-sm outline-none focus:border-sage focus:bg-white"
      />
    </div>
  );
}

/* ---------------- Services ---------------- */

function ServicesEditor() {
  const qc = useQueryClient();
  const { data, isLoading } = useServices();
  const [items, setItems] = useState<Service[]>([]);
  const [saving, setSaving] = useState(false);
  const [msg, setMsg] = useState<string | null>(null);

  useEffect(() => { if (data) setItems(data); }, [data]);

  const update = (i: number, patch: Partial<Service>) =>
    setItems((arr) => arr.map((it, idx) => (idx === i ? { ...it, ...patch } : it)));

  const add = () => setItems((arr) => [
    ...arr,
    { id: `new-${Date.now()}`, title: "Novo serviço", duration: "", capacity: "", description: "", display_order: (arr.at(-1)?.display_order ?? 0) + 1 },
  ]);

  const remove = async (i: number) => {
    const it = items[i];
    if (!confirm(`Remover "${it.title}"?`)) return;
    if (!it.id.startsWith("new-")) {
      const { error } = await supabase.from("services").delete().eq("id", it.id);
      if (error) { alert(error.message); return; }
    }
    setItems((arr) => arr.filter((_, idx) => idx !== i));
    qc.invalidateQueries({ queryKey: ["services"] });
  };

  const save = async () => {
    setSaving(true); setMsg(null);
    try {
      for (const it of items) {
        if (it.id.startsWith("new-")) {
          const { id: _drop, ...payload } = it;
          void _drop;
          const { error } = await supabase.from("services").insert(payload);
          if (error) throw error;
        } else {
          const { id, ...payload } = it;
          const { error } = await supabase.from("services").update(payload).eq("id", id);
          if (error) throw error;
        }
      }
      setMsg("Salvo com sucesso!");
      qc.invalidateQueries({ queryKey: ["services"] });
    } catch (e) {
      setMsg(e instanceof Error ? e.message : "Erro ao salvar");
    } finally {
      setSaving(false);
    }
  };

  if (isLoading) return <Loader />;

  return (
    <div className="space-y-4">
      {items.map((it, i) => (
        <Card key={it.id}>
          <div className="flex items-start justify-between gap-2">
            <p className="text-xs font-semibold uppercase tracking-wider text-sage">Serviço #{i + 1}</p>
            <button onClick={() => remove(i)} className="text-muted-foreground hover:text-red-600"><Trash2 size={16} /></button>
          </div>
          <div className="mt-4 grid gap-4 md:grid-cols-2">
            <Field label="Título" value={it.title} onChange={(v) => update(i, { title: v })} />
            <Field label="Duração" value={it.duration} onChange={(v) => update(i, { duration: v })} />
            <Field label="Capacidade" value={it.capacity} onChange={(v) => update(i, { capacity: v })} />
            <Field label="Ordem" type="number" value={String(it.display_order)} onChange={(v) => update(i, { display_order: Number(v) || 0 })} />
            <div className="md:col-span-2">
              <TextArea label="Descrição" value={it.description} onChange={(v) => update(i, { description: v })} />
            </div>
          </div>
        </Card>
      ))}

      <ActionBar onAdd={add} onSave={save} saving={saving} message={msg} />
    </div>
  );
}

/* ---------------- Pricing ---------------- */

function PricingEditor() {
  const qc = useQueryClient();
  const { data, isLoading } = usePricing();
  const [items, setItems] = useState<PricingRow[]>([]);
  const [saving, setSaving] = useState(false);
  const [msg, setMsg] = useState<string | null>(null);

  useEffect(() => { if (data) setItems(data); }, [data]);

  const update = (i: number, patch: Partial<PricingRow>) =>
    setItems((arr) => arr.map((it, idx) => (idx === i ? { ...it, ...patch } : it)));

  const add = () => setItems((arr) => [
    ...arr,
    { id: `new-${Date.now()}`, time_label: "Nova jornada", solo_price: "", solo_capacity: "", duo_price: "", duo_capacity: "", display_order: (arr.at(-1)?.display_order ?? 0) + 1 },
  ]);

  const remove = async (i: number) => {
    const it = items[i];
    if (!confirm(`Remover "${it.time_label}"?`)) return;
    if (!it.id.startsWith("new-")) {
      const { error } = await supabase.from("pricing").delete().eq("id", it.id);
      if (error) { alert(error.message); return; }
    }
    setItems((arr) => arr.filter((_, idx) => idx !== i));
    qc.invalidateQueries({ queryKey: ["pricing"] });
  };

  const save = async () => {
    setSaving(true); setMsg(null);
    try {
      for (const it of items) {
        if (it.id.startsWith("new-")) {
          const { id: _drop, ...payload } = it;
          void _drop;
          const { error } = await supabase.from("pricing").insert(payload);
          if (error) throw error;
        } else {
          const { id, ...payload } = it;
          const { error } = await supabase.from("pricing").update(payload).eq("id", id);
          if (error) throw error;
        }
      }
      setMsg("Salvo com sucesso!");
      qc.invalidateQueries({ queryKey: ["pricing"] });
    } catch (e) {
      setMsg(e instanceof Error ? e.message : "Erro ao salvar");
    } finally {
      setSaving(false);
    }
  };

  if (isLoading) return <Loader />;

  return (
    <div className="space-y-4">
      {items.map((it, i) => (
        <Card key={it.id}>
          <div className="flex items-start justify-between gap-2">
            <p className="text-xs font-semibold uppercase tracking-wider text-sage">Jornada #{i + 1}</p>
            <button onClick={() => remove(i)} className="text-muted-foreground hover:text-red-600"><Trash2 size={16} /></button>
          </div>
          <div className="mt-4 grid gap-4 md:grid-cols-2">
            <Field label="Jornada (ex: 4h)" value={it.time_label} onChange={(v) => update(i, { time_label: v })} />
            <Field label="Ordem" type="number" value={String(it.display_order)} onChange={(v) => update(i, { display_order: Number(v) || 0 })} />
            <Field label="Preço — 1 terapeuta" value={it.solo_price} onChange={(v) => update(i, { solo_price: v })} />
            <Field label="Capacidade — 1 terapeuta" value={it.solo_capacity} onChange={(v) => update(i, { solo_capacity: v })} />
            <Field label="Preço — 2 terapeutas" value={it.duo_price} onChange={(v) => update(i, { duo_price: v })} />
            <Field label="Capacidade — 2 terapeutas" value={it.duo_capacity} onChange={(v) => update(i, { duo_capacity: v })} />
          </div>
        </Card>
      ))}

      <ActionBar onAdd={add} onSave={save} saving={saving} message={msg} />
    </div>
  );
}

/* ---------------- Contacts / Settings ---------------- */

const SETTINGS_FIELDS: { key: keyof SettingsMap; label: string; hint?: string }[] = [
  { key: "whatsappNumber", label: "WhatsApp (somente números)", hint: "Ex: 5519999999999 (DDI + DDD + número)" },
  { key: "whatsappMessage", label: "Mensagem padrão do WhatsApp" },
  { key: "email", label: "E-mail de contato" },
  { key: "instagram", label: "Link do Instagram" },
  { key: "city", label: "Cidade / região" },
];

function SettingsEditor() {
  const qc = useQueryClient();
  const { data, isLoading } = useSettings();
  const [draft, setDraft] = useState<SettingsMap | null>(null);
  const [saving, setSaving] = useState(false);
  const [msg, setMsg] = useState<string | null>(null);

  useEffect(() => { if (data) setDraft(data); }, [data]);

  const current = useMemo(() => draft ?? data, [draft, data]);

  const save = async () => {
    if (!current) return;
    setSaving(true); setMsg(null);
    try {
      const rows = Object.entries(current).map(([key, value]) => ({ key, value }));
      const { error } = await supabase.from("site_settings").upsert(rows, { onConflict: "key" });
      if (error) throw error;
      setMsg("Salvo com sucesso!");
      qc.invalidateQueries({ queryKey: ["site_settings"] });
    } catch (e) {
      setMsg(e instanceof Error ? e.message : "Erro ao salvar");
    } finally {
      setSaving(false);
    }
  };

  if (isLoading || !current) return <Loader />;

  return (
    <div className="space-y-4">
      <Card>
        <div className="grid gap-4">
          {SETTINGS_FIELDS.map((f) => (
            <div key={f.key}>
              <Field
                label={f.label}
                value={current[f.key]}
                onChange={(v) => setDraft({ ...current, [f.key]: v })}
              />
              {f.hint && <p className="mt-1 text-[11px] text-muted-foreground">{f.hint}</p>}
            </div>
          ))}
        </div>
      </Card>

      <div className="flex items-center justify-between">
        {msg ? <p className="text-xs text-sage-deep">{msg}</p> : <span />}
        <button
          onClick={save}
          disabled={saving}
          className="inline-flex items-center gap-2 rounded-full bg-sage px-5 py-2.5 text-sm font-medium text-cream hover:bg-sage-deep disabled:opacity-60"
        >
          {saving ? <Loader2 size={14} className="animate-spin" /> : <Save size={14} />}
          Salvar alterações
        </button>
      </div>
    </div>
  );
}

/* ---------------- Shared ---------------- */

function ActionBar({ onAdd, onSave, saving, message }: { onAdd: () => void; onSave: () => void; saving: boolean; message: string | null }) {
  return (
    <div className="flex flex-wrap items-center justify-between gap-3">
      <button onClick={onAdd} className="inline-flex items-center gap-2 rounded-full border border-sage/30 px-4 py-2 text-xs font-medium text-sage-deep hover:bg-sage/5">
        <Plus size={14} /> Adicionar
      </button>
      <div className="flex items-center gap-3">
        {message && <p className="text-xs text-sage-deep">{message}</p>}
        <button
          onClick={onSave}
          disabled={saving}
          className="inline-flex items-center gap-2 rounded-full bg-sage px-5 py-2.5 text-sm font-medium text-cream hover:bg-sage-deep disabled:opacity-60"
        >
          {saving ? <Loader2 size={14} className="animate-spin" /> : <Save size={14} />}
          Salvar alterações
        </button>
      </div>
    </div>
  );
}

function Loader() {
  return <div className="grid place-items-center py-12"><Loader2 className="animate-spin text-sage" /></div>;
}
