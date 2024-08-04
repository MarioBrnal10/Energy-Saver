import math

def metodo_euler(f, x0, y0, x_final, h):
    n_pasos = int((x_final - x0) / h) + 1
    valores_x = [x0 + i * h for i in range(n_pasos)]
    valores_y = [0] * n_pasos
    valores_exactos = [0] * n_pasos
    porcentajes_error = [0] * n_pasos
    
    valores_y[0] = y0
    valores_exactos[0] = y0
    porcentajes_error[0] = 0.0

    for i in range(1, n_pasos):
        valores_y[i] = valores_y[i-1] + h * f(valores_x[i-1], valores_y[i-1])
        valores_exactos[i] = math.exp(valores_x[i]) - valores_x[i] - 1  
        porcentajes_error[i] = abs(valores_exactos[i] - valores_y[i]) / valores_exactos[i]
    
    return valores_x, valores_y, valores_exactos, porcentajes_error

def f(x, y):
    return x + y

def main():
    try:
        h = float(input("Ingrese el valor de h: "))
        x0 = 0.0
        y0 = 1.0
        x_final = 1.0

        valores_x, valores_y, valores_exactos, porcentajes_error = metodo_euler(f, x0, y0, x_final, h)

        print("\nResultados:")
        print("{:<10} {:<15} {:<15} {:<15}".format("x_n", "y_n", "Exacto", "Error"))
        for x, y, exacto, error in zip(valores_x, valores_y, valores_exactos, porcentajes_error):
            print("{:<10.1f} {:<15.5f} {:<15.5f} {:<15.5f}".format(x, y, exacto, error))

    except ValueError:
        print("Por favor, ingrese un valor numérico para h.")

if __name__ == "__main__":
    main()
