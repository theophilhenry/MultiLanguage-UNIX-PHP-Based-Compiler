import fileinput

for line in fileinput.input():
    print(line, end="")


import time

print("Printed immediately.")
time.sleep(80.4)