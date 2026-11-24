<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca · Gestión de colecciones</title>
    <style>
        :root {
            --paper: #f6f5f1;
            --surface: #ffffff;
            --surface-muted: #fafaf7;
            --ink: #1e2420;
            --muted: #6b736d;
            --line: #e3e1da;
            --line-strong: #cfccc2;
            --accent: #235347;
            --accent-strong: #193f36;
            --accent-soft: #eef3f1;
            --danger: #a3312b;
            --danger-strong: #87241f;
            --danger-soft: #fbefed;
            --radius: 10px;
            --radius-sm: 7px;
            --shadow: 0 1px 2px rgba(24, 30, 27, .04), 0 10px 28px rgba(24, 30, 27, .05);
            --serif: "Iowan Old Style", "Palatino Linotype", Palatino, Georgia, "Times New Roman", serif;
            --sans: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: var(--sans);
            font-size: 15px;
            line-height: 1.5;
            color: var(--ink);
            background: var(--paper);
            -webkit-font-smoothing: antialiased;
        }

        svg {
            display: block;
        }

        /* ---------- Barra superior ---------- */

        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(246, 245, 241, .94);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
        }

        .topbar-inner {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            color: inherit;
            text-decoration: none;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: var(--ink);
            color: #fff;
        }

        .brand-mark svg {
            width: 18px;
            height: 18px;
        }

        .brand-copy strong {
            display: block;
            font-size: 15px;
            font-weight: 650;
            letter-spacing: -.01em;
            line-height: 1.25;
        }

        .brand-copy small {
            display: block;
            font-size: 11.5px;
            color: var(--muted);
            letter-spacing: .015em;
        }

        .topbar-meta {
            display: flex;
            align-items: center;
            gap: 13px;
            color: var(--muted);
            font-size: 12.5px;
        }

        .topbar-meta strong {
            color: var(--ink);
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        .topbar-meta .sep {
            width: 1px;
            height: 14px;
            background: var(--line-strong);
        }

        /* ---------- Estructura ---------- */

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 24px 72px;
        }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .eyebrow {
            margin: 0 0 7px;
            font-size: 10.5px;
            font-weight: 650;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--accent);
        }

        h1 {
            margin: 0;
            font-family: var(--serif);
            font-size: 34px;
            font-weight: 600;
            line-height: 1.08;
            letter-spacing: -.02em;
        }

        .lede {
            margin: 8px 0 0;
            max-width: 56ch;
            font-size: 13.5px;
            color: var(--muted);
        }

        .content {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 296px;
            gap: 20px;
            align-items: start;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-side {
            position: sticky;
            top: 88px;
        }

        @media (max-width: 920px) {
            .content {
                grid-template-columns: 1fr;
            }

            .panel-side {
                position: static;
            }

            .page {
                padding-top: 28px;
            }
        }

        @media (max-width: 560px) {
            .topbar-inner,
            .page {
                padding-left: 16px;
                padding-right: 16px;
            }

            h1 {
                font-size: 29px;
            }

            .topbar-meta .sep,
            .topbar-meta .meta-categories {
                display: none;
            }
        }

        /* ---------- Botones ---------- */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 14px;
            border: 1px solid transparent;
            border-radius: var(--radius-sm);
            font: inherit;
            font-size: 13px;
            font-weight: 600;
            line-height: 1;
            white-space: nowrap;
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .btn svg {
            width: 15px;
            height: 15px;
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-strong);
            border-color: var(--accent-strong);
        }

        .btn-ghost {
            background: var(--surface);
            border-color: var(--line-strong);
            color: var(--ink);
        }

        .btn-ghost:hover {
            background: #f7f7f4;
            border-color: #b8b4a9;
        }

        .btn-danger {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
        }

        .btn-danger:hover {
            background: var(--danger-strong);
            border-color: var(--danger-strong);
        }

        .btn:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .btn:focus-visible,
        .icon-btn:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            padding: 0;
        }

        .spinner {
            width: 13px;
            height: 13px;
            border: 2px solid rgba(255, 255, 255, .35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ---------- Panel de libros ---------- */

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 14px 18px;
            border-bottom: 1px solid var(--line);
            background: var(--surface);
        }

        .panel-title {
            margin: 0;
            font-size: 13.5px;
            font-weight: 650;
            letter-spacing: -.005em;
        }

        .panel-sub {
            font-size: 12.5px;
            color: var(--muted);
            font-variant-numeric: tabular-nums;
        }

        .filters {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .filters label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
            white-space: nowrap;
        }

        .filters select {
            width: auto;
            min-width: 190px;
        }

        /* ---------- Controles ---------- */

        input,
        select,
        textarea {
            width: 100%;
            padding: 9px 11px;
            font: inherit;
            font-size: 13.5px;
            color: var(--ink);
            background: var(--surface);
            border: 1px solid var(--line-strong);
            border-radius: var(--radius-sm);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa19c;
        }

        input:hover,
        select:hover,
        textarea:hover {
            border-color: #b6b2a7;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(35, 83, 71, .12);
        }

        select {
            appearance: none;
            padding-right: 34px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b736d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 11px center;
            background-size: 14px;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input[type="number"] {
            appearance: textfield;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            appearance: none;
            margin: 0;
        }

        /* ---------- Tabla ---------- */

        .table-scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 660px;
            border-collapse: collapse;
        }

        thead th {
            padding: 10px 18px;
            text-align: left;
            font-size: 10.5px;
            font-weight: 650;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--surface-muted);
            border-bottom: 1px solid var(--line);
        }

        thead th:last-child {
            text-align: right;
        }

        tbody td {
            padding: 13px 18px;
            border-bottom: 1px solid var(--line);
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:hover {
            background: #fbfbf8;
        }

        .book-title {
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: -.005em;
        }

        .book-description {
            margin-top: 2px;
            max-width: 380px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 12.5px;
            color: var(--muted);
        }

        .tag {
            display: inline-block;
            padding: 3px 8px;
            border: 1px solid var(--line);
            border-radius: 5px;
            background: #f4f4f0;
            color: #3c453f;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        .year {
            font-size: 13px;
            color: var(--muted);
            font-variant-numeric: tabular-nums;
        }

        .col-actions {
            width: 1%;
            text-align: right;
            white-space: nowrap;
        }

        .row-actions {
            display: inline-flex;
            gap: 2px;
        }

        .icon-btn {
            display: inline-grid;
            place-items: center;
            width: 30px;
            height: 30px;
            padding: 0;
            border: 1px solid transparent;
            border-radius: 6px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .icon-btn svg {
            width: 15px;
            height: 15px;
        }

        .icon-btn:hover {
            background: #f1f2ee;
            border-color: var(--line);
            color: var(--ink);
        }

        .icon-btn.is-danger:hover {
            background: var(--danger-soft);
            border-color: #efd4d0;
            color: var(--danger);
        }

        .icon-btn:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .icon-btn:disabled:hover {
            background: transparent;
            border-color: transparent;
            color: var(--muted);
        }

        /* ---------- Estado vacío ---------- */

        .empty {
            display: grid;
            justify-items: center;
            gap: 4px;
            padding: 54px 24px;
            text-align: center;
        }

        .empty[hidden] {
            display: none;
        }

        .empty-icon {
            display: grid;
            place-items: center;
            width: 40px;
            height: 40px;
            margin-bottom: 8px;
            border: 1px solid var(--line);
            border-radius: 50%;
            color: #98a09a;
        }

        .empty-icon svg {
            width: 18px;
            height: 18px;
        }

        .empty strong {
            font-size: 14px;
            font-weight: 600;
        }

        .empty span {
            max-width: 38ch;
            font-size: 12.5px;
            color: var(--muted);
        }

        /* ---------- Panel de categorías ---------- */

        .side-head {
            padding: 16px 18px 0;
        }

        .side-body {
            padding: 12px 18px 18px;
        }

        .side-note {
            margin: 4px 0 14px;
            font-size: 12px;
            line-height: 1.45;
            color: var(--muted);
        }

        .category-form {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 7px;
        }

        .category-error {
            min-height: 17px;
            margin: 5px 1px 4px;
            font-size: 11.5px;
            color: var(--danger);
        }

        .cat-list {
            margin: 4px 0 0;
            padding: 0;
            list-style: none;
            border-top: 1px solid var(--line);
        }

        .cat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 0;
            border-bottom: 1px solid var(--line);
            font-size: 13px;
        }

        .cat-item:last-child {
            border-bottom: 0;
        }

        .cat-name {
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 500;
        }

        .cat-count {
            font-size: 11.5px;
            color: var(--muted);
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .cat-empty {
            padding: 16px 0;
            font-size: 12.5px;
            color: var(--muted);
            text-align: center;
        }

        /* ---------- Diálogos ---------- */

        dialog {
            padding: 0;
            border: 0;
            background: transparent;
            color: var(--ink);
            max-width: 100%;
        }

        dialog::backdrop {
            background: rgba(24, 29, 26, .42);
            backdrop-filter: blur(2px);
        }

        .dialog-card {
            width: min(560px, calc(100vw - 32px));
            margin: 0;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 12px;
            box-shadow: 0 28px 70px rgba(18, 23, 20, .26);
        }

        .dialog-sm .dialog-card {
            width: min(420px, calc(100vw - 32px));
        }

        .dialog-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 22px 0;
        }

        .dialog-head h2 {
            margin: 0;
            font-family: var(--serif);
            font-size: 23px;
            font-weight: 600;
            line-height: 1.15;
            letter-spacing: -.015em;
        }

        .dialog-head p {
            margin: 5px 0 0;
            font-size: 12.5px;
            color: var(--muted);
        }

        .dialog-close {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            flex: none;
            padding: 0;
            border: 1px solid transparent;
            border-radius: 6px;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
        }

        .dialog-close:hover {
            background: #f2f2ee;
            border-color: var(--line);
            color: var(--ink);
        }

        .dialog-close svg {
            width: 16px;
            height: 16px;
        }

        .dialog-body {
            padding: 18px 22px 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            display: block;
            margin-bottom: 6px;
            font-size: 12.5px;
            font-weight: 600;
        }

        .field label .req {
            color: var(--danger);
            font-weight: 500;
        }

        .field-hint {
            margin-top: 5px;
            font-size: 11.5px;
            color: var(--muted);
        }

        .field-error {
            min-height: 16px;
            margin-top: 3px;
            font-size: 11.5px;
            color: var(--danger);
        }

        .dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 15px 22px;
            background: var(--surface-muted);
            border-top: 1px solid var(--line);
        }

        .confirm-body {
            padding: 24px 24px 20px;
        }

        .confirm-icon {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            margin-bottom: 14px;
            border-radius: 50%;
            background: var(--danger-soft);
            color: var(--danger);
        }

        .confirm-icon svg {
            width: 17px;
            height: 17px;
        }

        .confirm-body h2 {
            margin: 0;
            font-family: var(--serif);
            font-size: 21px;
            font-weight: 600;
            letter-spacing: -.012em;
        }

        .confirm-body p {
            margin: 8px 0 0;
            font-size: 13px;
            line-height: 1.55;
            color: var(--muted);
        }

        .confirm-body strong {
            color: var(--ink);
            font-weight: 600;
        }

        @media (max-width: 560px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ---------- Aviso flotante ---------- */

        .toast {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 60;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            max-width: min(380px, calc(100vw - 32px));
            padding: 11px 14px;
            border-radius: 8px;
            background: #1f2623;
            color: #f4f5f3;
            font-size: 12.5px;
            line-height: 1.45;
            box-shadow: 0 14px 36px rgba(18, 23, 20, .3);
            opacity: 0;
            transform: translateY(8px);
            pointer-events: none;
            transition: opacity .18s ease, transform .18s ease;
        }

        .toast.show {
            opacity: 1;
            transform: none;
        }

        .toast svg {
            width: 15px;
            height: 15px;
            flex: none;
            margin-top: 1px;
        }

        .toast.success svg {
            color: #8fd6b2;
        }

        .toast.error svg {
            color: #f0a19a;
        }

        .toast.warning svg {
            color: #e5c27b;
        }

        @media (max-width: 560px) {
            .toast {
                right: 16px;
                bottom: 16px;
            }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <a class="brand" href="/" aria-label="Biblioteca, inicio">
            <span class="brand-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                </svg>
            </span>
            <span class="brand-copy">
                <strong>Biblioteca</strong>
                <small>Gestión de colecciones</small>
            </span>
        </a>

        <div class="topbar-meta" aria-live="polite">
            <span><strong id="stat-books">—</strong> libros</span>
            <span class="sep" aria-hidden="true"></span>
            <span class="meta-categories"><strong id="stat-categories">—</strong> categorías</span>
        </div>
    </div>
</header>

<main class="page">
    <div class="page-head">
        <div>
            <p class="eyebrow">Catálogo</p>
            <h1>Libros</h1>
            <p class="lede">Administra el catálogo de la biblioteca y su clasificación por categorías.</p>
        </div>

        <button type="button" class="btn btn-primary" id="new-book-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" aria-hidden="true">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Nuevo libro
        </button>
    </div>

    <div class="content">
        <section class="panel" aria-labelledby="books-heading">
            <div class="panel-head">
                <div class="filters">
                    <label for="filter-category">Categoría</label>
                    <select id="filter-category">
                        <option value="">Todas las categorías</option>
                    </select>
                </div>
                <span class="panel-sub" id="books-hint"></span>
            </div>

            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Año</th>
                            <th scope="col" class="col-actions">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="books-body"></tbody>
                </table>
            </div>

            <div class="empty" id="books-empty" hidden>
                <div class="empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                    </svg>
                </div>
                <strong>No hay libros para mostrar</strong>
                <span id="books-empty-hint">Crea el primer libro del catálogo con el botón «Nuevo libro».</span>
            </div>
        </section>

        <aside class="panel panel-side" aria-labelledby="categories-heading">
            <div class="side-head">
                <h2 class="panel-title" id="categories-heading">Categorías</h2>
            </div>

            <div class="side-body">
                <p class="side-note">Una categoría con libros asociados no se puede eliminar.</p>

                <form class="category-form" id="category-form" novalidate>
                    <input type="text" name="name" id="category-name" placeholder="Nueva categoría"
                           maxlength="255" aria-label="Nombre de la categoría" required>
                    <button type="submit" class="btn btn-ghost btn-icon" id="category-submit"
                            aria-label="Añadir categoría" title="Añadir categoría">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" aria-hidden="true">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                    </button>
                </form>
                <div class="category-error" id="category-error" aria-live="polite"></div>

                <ul class="cat-list" id="categories-list"></ul>
            </div>
        </aside>
    </div>
</main>

<dialog id="book-dialog" aria-labelledby="dialog-title">
    <form id="book-form" class="dialog-card" novalidate>
        <div class="dialog-head">
            <div>
                <h2 id="dialog-title">Nuevo libro</h2>
                <p id="dialog-subtitle">Completa la ficha del libro.</p>
            </div>
            <button type="button" class="dialog-close" id="dialog-close" aria-label="Cerrar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" aria-hidden="true">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="dialog-body">
            <div class="form-grid">
                <div class="field">
                    <label for="book-title">Título <span class="req" aria-hidden="true">*</span></label>
                    <input type="text" id="book-title" name="title" maxlength="255" required>
                    <div class="field-error" data-error="title"></div>
                </div>

                <div class="field">
                    <label for="book-author">Autor <span class="req" aria-hidden="true">*</span></label>
                    <input type="text" id="book-author" name="author" maxlength="255" required>
                    <div class="field-error" data-error="author"></div>
                </div>

                <div class="field">
                    <label for="book-year">Año de publicación <span class="req" aria-hidden="true">*</span></label>
                    <input type="number" id="book-year" name="published_year" min="1000"
                           max="{{ now()->year }}" required>
                    <div class="field-hint">Entre 1000 y {{ now()->year }}.</div>
                    <div class="field-error" data-error="published_year"></div>
                </div>

                <div class="field">
                    <label for="book-category">Categoría <span class="req" aria-hidden="true">*</span></label>
                    <select id="book-category" name="category_id" required></select>
                    <div class="field-error" data-error="category_id"></div>
                </div>

                <div class="field full">
                    <label for="book-description">Descripción</label>
                    <textarea id="book-description" name="description" maxlength="5000"
                              placeholder="Sinopsis o notas del libro (opcional)"></textarea>
                    <div class="field-error" data-error="description"></div>
                </div>
            </div>
        </div>

        <div class="dialog-actions">
            <button type="button" class="btn btn-ghost" id="dialog-cancel">Cancelar</button>
            <button type="submit" class="btn btn-primary" id="book-submit">Guardar</button>
        </div>
    </form>
</dialog>

<dialog id="confirm-dialog" class="dialog-sm" aria-labelledby="confirm-title"
        aria-describedby="confirm-message">
    <form method="dialog" class="dialog-card">
        <div class="confirm-body">
            <div class="confirm-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"/>
                </svg>
            </div>
            <h2 id="confirm-title">Eliminar registro</h2>
            <p id="confirm-message"></p>
        </div>

        <div class="dialog-actions">
            <button type="submit" value="cancel" class="btn btn-ghost" autofocus>Cancelar</button>
            <button type="submit" value="confirm" class="btn btn-danger" id="confirm-accept">Eliminar</button>
        </div>
    </form>
</dialog>

<div class="toast" id="toast" role="status" aria-live="polite">
    <span id="toast-icon" aria-hidden="true"></span>
    <span id="toast-message"></span>
</div>

<script>
(() => {
    'use strict';

    const state = {
        books: [],
        categories: [],
        filter: '',
        editingId: null,
        saving: false,
    };

    const els = {
        booksBody: document.getElementById('books-body'),
        booksEmpty: document.getElementById('books-empty'),
        booksEmptyHint: document.getElementById('books-empty-hint'),
        booksHint: document.getElementById('books-hint'),
        statBooks: document.getElementById('stat-books'),
        statCategories: document.getElementById('stat-categories'),
        filter: document.getElementById('filter-category'),
        categoriesList: document.getElementById('categories-list'),
        categoryForm: document.getElementById('category-form'),
        categoryName: document.getElementById('category-name'),
        categorySubmit: document.getElementById('category-submit'),
        categoryError: document.getElementById('category-error'),
        newBookBtn: document.getElementById('new-book-btn'),
        dialog: document.getElementById('book-dialog'),
        dialogTitle: document.getElementById('dialog-title'),
        dialogSubtitle: document.getElementById('dialog-subtitle'),
        dialogClose: document.getElementById('dialog-close'),
        dialogCancel: document.getElementById('dialog-cancel'),
        form: document.getElementById('book-form'),
        submit: document.getElementById('book-submit'),
        bookCategory: document.getElementById('book-category'),
        confirmDialog: document.getElementById('confirm-dialog'),
        confirmTitle: document.getElementById('confirm-title'),
        confirmMessage: document.getElementById('confirm-message'),
        confirmAccept: document.getElementById('confirm-accept'),
        toast: document.getElementById('toast'),
        toastIcon: document.getElementById('toast-icon'),
        toastMessage: document.getElementById('toast-message'),
    };

    const icons = {
        edit: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>',
        trash: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"/></svg>',
        success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>',
        error: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>',
        warning: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.6 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.6a2 2 0 0 0-3.4 0Z"/><path d="M12 9v4M12 17h.01"/></svg>',
    };

    const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;',
    }[char]));

    let toastTimer;

    function notify(message, type = 'success') {
        clearTimeout(toastTimer);
        els.toastMessage.textContent = message;
        els.toastIcon.innerHTML = icons[type] || icons.success;
        els.toast.className = `toast show ${type}`;
        toastTimer = setTimeout(() => {
            els.toast.className = 'toast';
        }, 4200);
    }

    async function request(path, options = {}) {
        const response = await fetch(path, {
            ...options,
            headers: {
                Accept: 'application/json',
                ...(options.body ? { 'Content-Type': 'application/json' } : {}),
                ...(options.headers || {}),
            },
        });

        if (response.status === 204) {
            return null;
        }

        const payload = await response.json().catch(() => ({}));

        if (!response.ok) {
            const error = new Error(payload.message || 'No se pudo completar la operación.');
            error.status = response.status;
            error.payload = payload;
            throw error;
        }

        return payload;
    }

    function payloadList(payload) {
        return Array.isArray(payload) ? payload : (payload?.data ?? []);
    }

    function totalBooks() {
        return state.categories.reduce((total, category) => total + Number(category.books_count || 0), 0);
    }

    function updateBooksHint() {
        const total = totalBooks();
        if (state.filter) {
            els.booksHint.textContent = `${state.books.length} de ${total} libros`;
        } else {
            els.booksHint.textContent = total === 1 ? '1 libro' : `${state.books.length} libros`;
        }
    }

    function clearFormErrors() {
        document.querySelectorAll('[data-error]').forEach((node) => {
            node.textContent = '';
        });
        els.form.querySelectorAll('[aria-invalid="true"]').forEach((node) => {
            node.removeAttribute('aria-invalid');
        });
    }

    function showFormErrors(errors = {}) {
        let firstInvalid = null;

        Object.entries(errors).forEach(([field, messages]) => {
            const node = document.querySelector(`[data-error="${field}"]`);
            const input = els.form.querySelector(`[name="${field}"]`);

            if (node) {
                node.textContent = Array.isArray(messages) ? messages[0] : String(messages);
            }

            if (input) {
                input.setAttribute('aria-invalid', 'true');
                firstInvalid = firstInvalid || input;
            }
        });

        firstInvalid?.focus();
    }

    function resetBookForm() {
        els.form.reset();
        state.editingId = null;
        clearFormErrors();
    }

    function fillCategorySelect(select, includeAll) {
        const current = select.value;
        const options = [];

        if (includeAll) {
            options.push('<option value="">Todas las categorías</option>');
        }

        state.categories.forEach((category) => {
            options.push(`<option value="${category.id}">${escapeHtml(category.name)}</option>`);
        });

        select.innerHTML = options.join('');
        select.value = current;
    }

    function openDialog(book = null) {
        if (state.categories.length === 0) {
            notify('Primero crea al menos una categoría.', 'warning');
            return;
        }

        resetBookForm();
        fillCategorySelect(els.bookCategory, false);

        if (book) {
            state.editingId = book.id;
            els.dialogTitle.textContent = 'Editar libro';
            els.dialogSubtitle.textContent = 'Actualiza la información del libro.';
            els.submit.textContent = 'Guardar cambios';
            els.form.title.value = book.title;
            els.form.author.value = book.author;
            els.form.published_year.value = book.published_year;
            els.form.category_id.value = book.category_id;
            els.form.description.value = book.description ?? '';
        } else {
            els.dialogTitle.textContent = 'Nuevo libro';
            els.dialogSubtitle.textContent = 'Completa la ficha del libro.';
            els.submit.textContent = 'Guardar';
            els.form.category_id.value = String(state.categories[0]?.id ?? '');
        }

        els.dialog.showModal();
        els.form.title.focus();
    }

    function closeDialog() {
        els.dialog.close();
        resetBookForm();
    }

    function setSaving(saving) {
        state.saving = saving;
        els.submit.disabled = saving;
        els.submit.innerHTML = saving
            ? '<span class="spinner" aria-hidden="true"></span> Guardando…'
            : (state.editingId ? 'Guardar cambios' : 'Guardar');
    }

    function renderBooks() {
        const books = state.books;

        if (books.length === 0) {
            els.booksBody.innerHTML = '';
            els.booksEmpty.hidden = false;
            els.booksEmptyHint.textContent = state.filter
                ? 'No hay libros registrados en esta categoría.'
                : 'Crea el primer libro del catálogo con el botón «Nuevo libro».';
            updateBooksHint();
            return;
        }

        els.booksEmpty.hidden = true;
        els.booksBody.innerHTML = books.map((book) => `
            <tr>
                <td>
                    <div class="book-title">${escapeHtml(book.title)}</div>
                    ${book.description
                        ? `<div class="book-description">${escapeHtml(book.description)}</div>`
                        : ''}
                </td>
                <td>${escapeHtml(book.author)}</td>
                <td><span class="tag">${escapeHtml(book.category?.name ?? 'Sin categoría')}</span></td>
                <td class="year">${escapeHtml(book.published_year)}</td>
                <td class="col-actions">
                    <div class="row-actions">
                        <button type="button" class="icon-btn" data-action="edit" data-id="${book.id}"
                                title="Editar" aria-label="Editar ${escapeHtml(book.title)}">
                            ${icons.edit}
                        </button>
                        <button type="button" class="icon-btn is-danger" data-action="delete" data-id="${book.id}"
                                title="Eliminar" aria-label="Eliminar ${escapeHtml(book.title)}">
                            ${icons.trash}
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        updateBooksHint();
    }

    function renderCategories() {
        els.statCategories.textContent = state.categories.length;
        els.statBooks.textContent = totalBooks();

        if (state.categories.length === 0) {
            els.categoriesList.innerHTML = '<li class="cat-empty">Todavía no hay categorías registradas.</li>';
            fillCategorySelect(els.filter, true);
            els.filter.value = state.filter;
            updateBooksHint();
            return;
        }

        els.categoriesList.innerHTML = state.categories.map((category) => {
            const count = Number(category.books_count || 0);
            const label = count === 1 ? '1 libro' : `${count} libros`;
            const disabled = count > 0;

            return `
                <li class="cat-item">
                    <span class="cat-name">${escapeHtml(category.name)}</span>
                    <span class="cat-count">${label}</span>
                    <button type="button" class="icon-btn is-danger" data-category-delete="${category.id}"
                            title="${disabled ? 'No se puede eliminar: tiene libros asociados' : 'Eliminar categoría'}"
                            aria-label="Eliminar ${escapeHtml(category.name)}" ${disabled ? 'disabled' : ''}>
                        ${icons.trash}
                    </button>
                </li>
            `;
        }).join('');

        fillCategorySelect(els.filter, true);
        els.filter.value = state.filter;
        updateBooksHint();
    }

    async function loadBooks() {
        const query = state.filter ? `?category=${encodeURIComponent(state.filter)}` : '';
        const payload = await request(`/books${query}`);
        state.books = payloadList(payload);
        renderBooks();
    }

    async function loadCategories() {
        const payload = await request('/categories');
        state.categories = payloadList(payload);

        if (state.filter && !state.categories.some((category) => String(category.id) === state.filter)) {
            state.filter = '';
            await loadBooks();
        }

        renderCategories();
    }

    async function loadAll() {
        try {
            await Promise.all([loadBooks(), loadCategories()]);
        } catch (error) {
            notify(error.message, 'error');
        }
    }

    function askConfirmation({ title, message, confirmLabel = 'Eliminar' }) {
        if (els.confirmDialog.open) {
            return Promise.resolve(false);
        }

        return new Promise((resolve) => {
            els.confirmTitle.textContent = title;
            els.confirmMessage.innerHTML = message;
            els.confirmAccept.textContent = confirmLabel;
            els.confirmDialog.returnValue = '';

            const onClose = () => {
                els.confirmDialog.removeEventListener('close', onClose);
                resolve(els.confirmDialog.returnValue === 'confirm');
            };

            els.confirmDialog.addEventListener('close', onClose);
            els.confirmDialog.showModal();
        });
    }

    async function saveBook(event) {
        event.preventDefault();

        if (state.saving) {
            return;
        }

        clearFormErrors();

        const form = els.form;
        const data = {
            title: form.title.value.trim(),
            author: form.author.value.trim(),
            description: form.description.value.trim() || null,
            published_year: Number(form.published_year.value),
            category_id: Number(form.category_id.value),
        };

        setSaving(true);

        try {
            if (state.editingId) {
                await request(`/books/${state.editingId}`, {
                    method: 'PUT',
                    body: JSON.stringify(data),
                });
                closeDialog();
                notify('Libro actualizado correctamente.', 'success');
            } else {
                await request('/books', {
                    method: 'POST',
                    body: JSON.stringify(data),
                });
                closeDialog();
                notify('Libro creado correctamente.', 'success');
            }

            await Promise.all([loadBooks(), loadCategories()]);
        } catch (error) {
            if (error.status === 422) {
                showFormErrors(error.payload?.errors);
                notify('Revisa los campos del formulario.', 'warning');
            } else {
                notify(error.message, 'error');
            }
        } finally {
            setSaving(false);
        }
    }

    const pendingDeletes = new Set();

    async function deleteBook(id) {
        const key = `book:${id}`;

        if (pendingDeletes.has(key)) {
            return;
        }

        const book = state.books.find((item) => item.id === id);
        if (!book) {
            return;
        }

        pendingDeletes.add(key);

        try {
            const confirmed = await askConfirmation({
                title: 'Eliminar libro',
                message: `Se eliminará <strong>«${escapeHtml(book.title)}»</strong> del catálogo. Esta acción no se puede deshacer.`,
                confirmLabel: 'Eliminar libro',
            });

            if (!confirmed) {
                return;
            }

            await request(`/books/${id}`, { method: 'DELETE' });
            notify('Libro eliminado.', 'success');
            await Promise.all([loadBooks(), loadCategories()]);
        } catch (error) {
            notify(error.message, 'error');
        } finally {
            pendingDeletes.delete(key);
        }
    }

    async function createCategory(event) {
        event.preventDefault();
        els.categoryError.textContent = '';

        const name = els.categoryName.value.trim();
        if (name === '') {
            els.categoryError.textContent = 'El nombre es obligatorio.';
            els.categoryName.focus();
            return;
        }

        els.categorySubmit.disabled = true;

        try {
            await request('/categories', {
                method: 'POST',
                body: JSON.stringify({ name }),
            });
            els.categoryForm.reset();
            notify('Categoría creada.', 'success');
            await loadCategories();
        } catch (error) {
            if (error.status === 422) {
                els.categoryError.textContent = error.payload?.errors?.name?.[0] ?? 'Datos no válidos.';
                els.categoryName.focus();
            } else {
                notify(error.message, 'error');
            }
        } finally {
            els.categorySubmit.disabled = false;
        }
    }

    async function deleteCategory(id) {
        const key = `category:${id}`;

        if (pendingDeletes.has(key)) {
            return;
        }

        const category = state.categories.find((item) => item.id === id);
        if (!category) {
            return;
        }

        pendingDeletes.add(key);

        try {
            const confirmed = await askConfirmation({
                title: 'Eliminar categoría',
                message: `Se eliminará <strong>«${escapeHtml(category.name)}»</strong>. Esta acción no se puede deshacer.`,
                confirmLabel: 'Eliminar categoría',
            });

            if (!confirmed) {
                return;
            }

            await request(`/categories/${id}`, { method: 'DELETE' });
            notify('Categoría eliminada.', 'success');
            await loadCategories();
        } catch (error) {
            if (error.status === 409) {
                notify(error.message, 'warning');
            } else {
                notify(error.message, 'error');
            }
        } finally {
            pendingDeletes.delete(key);
        }
    }

    els.newBookBtn.addEventListener('click', () => openDialog());
    els.dialogClose.addEventListener('click', closeDialog);
    els.dialogCancel.addEventListener('click', closeDialog);
    els.form.addEventListener('submit', saveBook);
    els.categoryForm.addEventListener('submit', createCategory);

    els.form.addEventListener('input', (event) => {
        const field = event.target.name;
        const node = field ? document.querySelector(`[data-error="${field}"]`) : null;

        if (node) {
            node.textContent = '';
        }

        if (event.target.getAttribute('aria-invalid') === 'true') {
            event.target.removeAttribute('aria-invalid');
        }
    });

    els.dialog.addEventListener('cancel', (event) => {
        if (state.saving) {
            event.preventDefault();
        }
    });

    els.dialog.addEventListener('close', () => {
        if (!state.saving) {
            resetBookForm();
        }
    });

    els.filter.addEventListener('change', async () => {
        state.filter = els.filter.value;
        try {
            await loadBooks();
        } catch (error) {
            notify(error.message, 'error');
        }
    });

    els.booksBody.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-action]');
        if (!button) {
            return;
        }

        const id = Number(button.dataset.id);

        if (button.dataset.action === 'edit') {
            const book = state.books.find((item) => item.id === id);
            if (book) {
                openDialog(book);
            }
        }

        if (button.dataset.action === 'delete') {
            deleteBook(id);
        }
    });

    els.categoriesList.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-category-delete]');
        if (button && !button.disabled) {
            deleteCategory(Number(button.dataset.categoryDelete));
        }
    });

    els.filter.value = '';
    loadAll();
})();
</script>
</body>
</html>
