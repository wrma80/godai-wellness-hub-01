import { createFileRoute, useNavigate } from "@tanstack/react-router";
import { useEffect, useState, type FormEvent } from "react";
import { supabase } from "@/integrations/supabase/client";
import { useAuth } from "@/hooks/use-auth";

export const Route = createFileRoute("/admin/login")({
  component: LoginPage,
});

function LoginPage() {
  const navigate = useNavigate();
  const { session, loading } = useAuth();
  const [mode, setMode] = useState<"signin" | "signup">("signin");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState<string | null>(null);
  const [busy, setBusy] = useState(false);

  useEffect(() => {
    if (!loading && session) navigate({ to: "/admin" });
  }, [loading, session, navigate]);

  const onSubmit = async (e: FormEvent) => {
    e.preventDefault();
    setBusy(true);
    setError(null);
    try {
      if (mode === "signin") {
        const { error } = await supabase.auth.signInWithPassword({ email, password });
        if (error) throw error;
      } else {
        const { error } = await supabase.auth.signUp({
          email,
          password,
          options: { emailRedirectTo: window.location.origin + "/admin" },
        });
        if (error) throw error;
      }
      navigate({ to: "/admin" });
    } catch (err) {
      setError(err instanceof Error ? err.message : "Erro ao autenticar.");
    } finally {
      setBusy(false);
    }
  };

  return (
    <div className="mx-auto max-w-md">
      <div className="rounded-2xl border border-sage/10 bg-white p-8 shadow-sm">
        <h1 className="text-2xl font-semibold text-sage-deep">Painel Administrativo</h1>
        <p className="mt-2 text-sm text-muted-foreground">
          {mode === "signin" ? "Entre com seu e-mail e senha." : "Crie sua conta de administrador."}
        </p>

        <form onSubmit={onSubmit} className="mt-6 space-y-4">
          <div>
            <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">E-mail</label>
            <input
              type="email"
              required
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="mt-2 w-full rounded-lg border border-sage/15 bg-cream/40 px-4 py-3 text-sm outline-none focus:border-sage focus:bg-white"
            />
          </div>
          <div>
            <label className="text-xs font-medium uppercase tracking-wider text-sage-deep">Senha</label>
            <input
              type="password"
              required
              minLength={6}
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="mt-2 w-full rounded-lg border border-sage/15 bg-cream/40 px-4 py-3 text-sm outline-none focus:border-sage focus:bg-white"
            />
          </div>
          {error && <p className="rounded-md bg-red-50 px-3 py-2 text-xs text-red-700">{error}</p>}
          <button
            type="submit"
            disabled={busy}
            className="inline-flex w-full items-center justify-center rounded-full bg-sage px-6 py-3 text-sm font-medium text-cream hover:bg-sage-deep disabled:opacity-60"
          >
            {busy ? "Aguarde..." : mode === "signin" ? "Entrar" : "Criar conta"}
          </button>
        </form>

        <button
          type="button"
          onClick={() => setMode((m) => (m === "signin" ? "signup" : "signin"))}
          className="mt-6 w-full text-center text-xs text-sage-deep/70 hover:text-sage"
        >
          {mode === "signin" ? "Primeiro acesso? Criar conta" : "Já tenho conta. Entrar"}
        </button>
      </div>
    </div>
  );
}
