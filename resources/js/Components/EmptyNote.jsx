/** The placeholder shown when a listing has nothing to show yet. */
export default function EmptyNote({ title, body }) {
    return (
        <div className="mt-14 flex flex-col items-center gap-3 border border-dashed border-sumi-900/15 px-6 py-20 text-center">
            <span className="font-mincho text-xl tracking-[0.14em] text-sumi-900">{title}</span>
            <span className="max-w-md text-sm leading-relaxed text-nezumi-500">{body}</span>
        </div>
    );
}
