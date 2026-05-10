import { createFileRoute, Outlet, Link, useRouterState } from "@tanstack/react-router";

export const Route = createFileRoute("/admin")({
  head: () => ({
    meta: [
      { title: "Painel — Godai Terapias" },
      { name: "robots", content: "noindex,nofollow" },
    ],
  }),
  component: AdminLayout,
});

function AdminLayout() {
  const path = useRouterState({ select: (r) => r.location.pathname });
  const isLogin = path === "/admin/login";

  return (
    <div className="-mt-20 min-h-screen bg-cream">
      <div className="mx-auto max-w-6xl px-6 py-24 lg:px-10">
        {!isLogin && (
          <div className="mb-8 flex items-center justify-between">
            <Link to="/admin" className="text-sm font-semibold uppercase tracking-[0.25em] text-sage">
              Painel Godai
            </Link>
            <Link to="/" className="text-xs text-muted-foreground hover:text-sage">
              Ver site →
            </Link>
          </div>
        )}
        <Outlet />
      </div>
    </div>
  );
}
