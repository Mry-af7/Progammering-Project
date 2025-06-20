import { Config, RouteParams, Router } from 'ziggy-js';

declare global {
    type ValidRouteName = keyof ZiggyRoute;

    interface ZiggyRoute {
        login: string;
        'password.request': string;
        'password.email': string;
        'password.reset': string;
        'password.store': string;
        register: string;
        'register.bedrijf': string;
        // Add other route names as needed
    }

    function route(): Router;
    function route(name: undefined, params: undefined, absolute?: boolean, config?: Config): Router;
    function route<T extends ValidRouteName>(
        name: T,
        params?: RouteParams | undefined,
        absolute?: boolean,
        config?: Config
    ): string;
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof route;
    }
}

declare module 'ziggy-js' {
    interface RouteConfig {
        uri: string;
        methods: string[];
        domain?: string | null;
        bindings?: Record<string, string>;
        parameters?: string[];
        wheres?: Record<string, string>;
    }

    interface ZiggyConfig {
        url: string;
        port: number | null;
        defaults: Record<string, string>;
        routes: Record<string, RouteConfig>;
    }

    type RouteParam = string | number | Record<string, any>;
    type RouteParamsWithQueryOverload = RouteParam | RouteParam[] | Record<string, RouteParam>;

    interface ZiggyRouter {
        current(): string;
        current(name: string): boolean;
        check(name: string): boolean;
        has(name: string): boolean;
    }

    type RouteFunction = {
        (name: string, params?: RouteParamsWithQueryOverload, absolute?: boolean): string;
        (): ZiggyRouter;
        current(): string;
        current(name: string): boolean;
        check(name: string): boolean;
        has(name: string): boolean;
    }

    const route: RouteFunction;
    export default route;
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: (name: string, params?: any) => string;
    }
}

declare module '@/types/ziggy' {
    export function route(name: string, params?: Record<string, any>, absolute?: boolean): string;
}

export { route };
