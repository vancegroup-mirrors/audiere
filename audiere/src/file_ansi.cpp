#include <stdio.h>
#include "default_file.h"


namespace audiere {

  class CFile : public RefImplementation<File> {
  public:
    CFile(FILE* file) {
      m_file = file;
    }

    ~CFile() {
      fclose(m_file);
    }

    int ADR_CALL read(void* buffer, int size) {
      return fread(buffer, 1, size, m_file);
    }

    bool ADR_CALL seek(int position, SeekMode mode) {
      int m;
      switch (mode) {
        case BEGIN:   m = SEEK_SET; break;
        case CURRENT: m = SEEK_CUR; break;
        case END:     m = SEEK_END; break;
        default: return false;
      }

      return (fseek(m_file, position, m) == 0);
    }

    int ADR_CALL tell() {
      return ftell(m_file);
    }

  private:
    FILE* m_file;
  };


  File* OpenDefaultFile(const char* filename) {
    FILE* file = fopen(filename, "rb");
    return (file ? new CFile(file) : 0);
  }

}
