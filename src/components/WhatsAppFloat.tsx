import { useSettings, buildWhatsappLink, DEFAULT_SETTINGS } from "@/lib/cms";

export function WhatsAppFloat() {
  const { data } = useSettings();
  return (
    <a
      href={buildWhatsappLink(data ?? DEFAULT_SETTINGS)}
      target="_blank"
      rel="noreferrer"
      aria-label="Falar no WhatsApp"
      className="fixed bottom-6 right-6 z-40 grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-lg transition-transform hover:scale-110 float-gentle"
    >
      <svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor" aria-hidden="true">
        <path d="M19.11 17.21c-.27-.14-1.6-.79-1.85-.88-.25-.09-.43-.14-.61.14-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.14-1.14-.42-2.17-1.34-.8-.71-1.34-1.59-1.5-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.32.41-.48.14-.16.18-.27.27-.45.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.84-2.02-.22-.53-.45-.46-.61-.47l-.52-.01c-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.29 0 1.35.98 2.66 1.12 2.84.14.18 1.94 2.96 4.7 4.15.66.28 1.17.45 1.57.58.66.21 1.26.18 1.74.11.53-.08 1.6-.65 1.83-1.28.23-.63.23-1.17.16-1.28-.07-.11-.25-.18-.52-.32zM12.04 21.5h-.01a9.46 9.46 0 0 1-4.82-1.32l-.35-.21-3.58.94.95-3.49-.23-.36a9.45 9.45 0 1 1 17.5-5.04 9.46 9.46 0 0 1-9.46 9.48zm8.05-17.53A11.45 11.45 0 0 0 2.05 17.5L0 24l6.66-1.74a11.43 11.43 0 0 0 5.38 1.37h.01a11.45 11.45 0 0 0 8.04-19.66z"/>
      </svg>
    </a>
  );
}
